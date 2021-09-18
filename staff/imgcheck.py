import os.path
from os import path
import time
import numpy as np
import cv2
import random
import requests

def check():
        while len(os.listdir('upload'))==0:
                time.sleep(1)

def file():
        while len(os.listdir('upload'))!=0:
                face_cascade = cv2.CascadeClassifier('data\\xml\\haarcascade_frontalface_default.xml')
                eye_cascade = cv2.CascadeClassifier('data\\xml\\haarcascade_eye.xml')
                mouth_cascade = cv2.CascadeClassifier('data\\xml\\haarcascade_mcs_mouth.xml')
                upper_body = cv2.CascadeClassifier('data\\xml\\haarcascade_upperbody.xml')



                # Adjust threshold value in range 80 to 105 based on your light.
                bw_threshold = 80

                # User message
                font = cv2.FONT_HERSHEY_SIMPLEX
                org = (30, 30)
                weared_mask_font_color = (255, 255, 255)
                not_weared_mask_font_color = (0, 0, 255)
                thickness = 2
                font_scale = 1
                weared_mask = "Thank You for wearing MASK"
                not_weared_mask = "Please wear MASK to defeat Corona"

                entries = os.listdir('upload/')
                for entry in entries:
                        cap = cv2.imread("upload/"+entry)
                        name=entry
                while 1:
                    # Get individual frame
                    img = cv2.flip(cap,1)

                    # Convert Image into gray
                    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

                    # Convert image in black and white
                    (thresh, black_and_white) = cv2.threshold(gray, bw_threshold, 255, cv2.THRESH_BINARY)
                    #cv2.imshow('black_and_white', black_and_white)

                    # detect face
                    faces = face_cascade.detectMultiScale(gray, 1.1, 4)

                    # Face prediction for black and white
                    faces_bw = face_cascade.detectMultiScale(black_and_white, 1.1, 4)
                   



                    if(len(faces) == 0 and len(faces_bw) == 0):
                        print('no face')
                        cv2.putText(img, "No face found...", org, font, font_scale, weared_mask_font_color, thickness, cv2.LINE_AA)
                        resp = requests.post('http://localhost/ANV ACADEMICS/staff/test.php?id=noface',params={"nam":name})
                        print(resp.content)
                        check()
                        break
                    elif(len(faces) == 0 and len(faces_bw) == 1):
                        print('white mask')
                        # It has been observed that for white mask covering mouth, with gray image face prediction is not happening
                        cv2.putText(img, weared_mask, org, font, font_scale, weared_mask_font_color, thickness, cv2.LINE_AA)
                        resp = requests.post('http://localhost/ANV ACADEMICS/staff/test.php?id=whitemask',params={"nam":name})
                        print(resp.content)
                        check()
                        break
                    else:
                        # Draw rectangle on gace
                        for (x, y, w, h) in faces:
                            cv2.rectangle(img, (x, y), (x + w, y + h), (255, 255, 255), 2)
                            roi_gray = gray[y:y + h, x:x + w]
                            roi_color = img[y:y + h, x:x + w]


                            # Detect lips counters
                            mouth_rects = mouth_cascade.detectMultiScale(gray, 1.5, 5)

                        # Face detected but Lips not detected which means person is wearing mask
                        if(len(mouth_rects) == 0):
                            print('mask detected')
                            cv2.putText(img, weared_mask, org, font, font_scale, weared_mask_font_color, thickness, cv2.LINE_AA)
                            resp = requests.post('http://localhost/ANV ACADEMICS/staff/test.php?id=mask',params={"nam":name})
                            print(resp.content)
                            check()
                            break
                        else:
                            for (mx, my, mw, mh) in mouth_rects:
                                if(y < my < y + h):
                                    print('no mask detected')
                                    # Face and Lips are detected but lips coordinates are within face cordinates which `means lips prediction is true and
                                    # person is not waring mask
                                    cv2.putText(img, not_weared_mask, org, font, font_scale, not_weared_mask_font_color, thickness, cv2.LINE_AA)
                                    resp = requests.post('http://localhost/ANV ACADEMICS/staff/test.php?id=nomask',params={"nam":name})
                                    print(resp.content)
                                    check()
                                    break
                                    #cv2.rectangle(img, (mx, my), (mx + mh, my + mw), (0, 0, 255), 3)
                                elif(mx < my < my + mh):
                                    print('no mask detected')
                                    # Face and Lips are detected but lips coordinates are within face cordinates which `means lips prediction is true and
                                    # person is not waring mask
                                    cv2.putText(img, not_weared_mask, org, font, font_scale, not_weared_mask_font_color, thickness, cv2.LINE_AA)
                                    resp = requests.post('http://localhost/ANV ACADEMICS/staff/test.php?id=nomask',params={"nam":name})
                                    print(resp.content)
                                    check()
                                    break
                                    #cv2.rectangle(img, (mx, my), (mx + mh, my + mw), (0, 0, 255), 3)
                        break                                

                                   
                        break                                
                    # Show frame with results
                    k = cv2.waitKey(30) & 0xff
                cv2.destroyAllWindows()
check()
file()
