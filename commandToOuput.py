import sys
import os
input_file=open('C:/xampp/htdocs/rqe/input1.txt','r')
output_file=open('C:/xampp/htdocs/rqe/output.txt','w')
sys.stdout=output_file
for each_line in input_file:
    try:
        op=str(eval(each_line))+'\n'
        print op
    except:
        exec(each_line)
input_file.close()
output_file.close()
