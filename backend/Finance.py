import mysql.connector as my
import re

# Changes the date format
def fun(o_date):
	l = str(o_date.group(0)).split('-')
	r=[]
	r.append('20'+l[2])
	if l[1]=='Jan':
		r.append('01')
	elif l[1]=='Feb':
		r.append('02')
	elif l[1]=='Mar':
		r.append('03')
	elif l[1]=='Apr':
		r.append('04')
	elif l[1]=='May':
		r.append('05')
	elif l[1]=='Jun':
		r.append('06')
	elif l[1]=='Jul':
		r.append('07')
	elif l[1]=='Aug':
		r.append('08')
	elif l[1]=='Sep':
		r.append('09')
	elif l[1]=='Oct':
		r.append('10')
	elif l[1]=='Nov':
		r.append('11')
	elif l[1]=='Dec':
		r.append('12')
	r.append(l[0])
	return (str(r[0])+'-'+str(r[1])+'-'+str(r[2]))



if __name__ == "__main__":
	names=['Microsoft']
	my_con = my.connect(host='localhost',user='root',password='root',database='finance')
	my_cur = my_con.cursor()
	log = open('logs.txt','w')
	for j in names:
		with open(j+'.csv','r') as f:
			r = f.read().split('\n')
			for i in range(1,len(r)-1):
				g1 = re.sub(r'\d{1,2}-[a-zA-Z]{3,3}-\d{2,2}',fun,r[i])
				g1 = g1.split(',')
				print(g1)
				if len(g1)>2:
					ins = "INSERT INTO `stocks` (`Company`,`Date`,`Open`,`High`,`Low`,`Close`,`Volume`) VALUES (%s,%s,%s,%s,%s,%s,%s)"
					val = (g1[0],g1[1],g1[2],g1[3],g1[4],g1[5],g1[6])
					#print(val)
					#print("inserting "+val[1]+"\n")
					try:
						my_cur.execute(ins,val)
						my_con.commit()
					except:
						print("----------")
						#log.write(str(val)+'\n')
	my_cur.close()
	my_con.close()
	log.close()
