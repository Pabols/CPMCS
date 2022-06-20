import serial
import sys
ser = serial.Serial("COM3", 4800, timeout=0.1)
while True:
    rd = ser.readline()
    if len(rd) > 1:
        temp = str(rd[3]) + '.' + str(rd[2])
        temp_int = float(temp)
        break
print(temp_int)