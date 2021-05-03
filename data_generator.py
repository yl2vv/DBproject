import random, string, csv

school_codes=[]
all_majors = []
education_level = ["High School", "Associates", "Bachelors", "Masters", "PhD"]
education_probs = [20, 20, 100, 30, 20]
years = ['1','2','3','4','4+']
years_probs = [10,10,10,10,2]
def get_lists():
	with open('majors.txt', 'r') as majors:
		for major in majors:
			all_majors.append(major.strip())

	with open('FedSchoolCodeList_ONLY_US.csv','r') as csvfile:
		reader = csv.reader(csvfile, delimiter=',')
		for row in reader:
			school_codes.append(row[0].strip())
		del school_codes[0]


def generate_ID():
	return''.join(random.choices(string.ascii_letters + string.digits, k=10))


if __name__ == '__main__':
	get_lists()
	usernames = open("usernames.txt", 'r')
	names = open("names.txt", 'r')
	emails = open("emails.txt", 'r')
	passwords = open("passwords.txt", 'r')

	personinput = open("personinput.csv", 'w')
	studentinput = open("studentinput.csv", 'w')
	advisorinput = open("advisorinput.csv", 'w')
	for i in range(100):
		randnum = random.uniform(0,1)
		username = usernames.readline().strip()
		name = names.readline().strip()
		email = emails.readline().strip()
		password_txt, password_hash = passwords.readline().strip().split(',')
		p = username + ',' + name+','+email+','+password_hash
		
		if randnum < 0.75:
			sid = generate_ID()
			p +=','+sid+',NULL'+'\n'
			s = sid+','+ random.choice(school_codes)+','+random.choice(all_majors)+','+random.choices(years,weights = years_probs,k=1)[0]+'\n'
			studentinput.write(s)
		elif randnum < 0.95:
			aid = generate_ID()
			p +=',NULL,'+aid+'\n'
			a = aid+','+random.choices(education_level,weights=education_probs,k=1)[0]+'\n'
			advisorinput.write(a)
		else:
			sid = generate_ID()
			s = sid+','+ random.choice(school_codes)+','+random.choice(all_majors)+','+random.choices(years,weights = years_probs,k=1)[0]+'\n'
			studentinput.write(s)
			aid = generate_ID()
			p +=','+sid+','+aid+'\n'
			a = aid+','+random.choices(education_level,weights=education_probs,k=1)[0]+'\n'
			advisorinput.write(a)

		personinput.write(p)