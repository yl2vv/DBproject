import csv
with open('majors.txt', 'r') as majors:
	new_majors = open("majors2.txt", 'w')
	for major in majors:
		if ',' in major:
			major = major.split(',')[0]
		new_majors.write(major.strip() + '\n')
