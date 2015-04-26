from urllib import request

# Retrieve the webpage as a string
names = ["Microsoft","Amazon","Intel"] 
links = ["http://www.google.com/finance/historical?q=NASDAQ%3AMSFT&ei=_BnOVJCPFcHNiwLbzoHAAg&output=csv","http://www.google.com/finance/historical?q=NASDAQ%3AGOOG&ei=3RbOVODXAsioiQKG8IHgAg&output=csv","http://www.google.com/finance/historical?q=NASDAQ%3AINTC&ei=DSjOVPKZB8HNiwLbzoHAAg&output=csv"]
for index in range(len(names)):
    response = request.urlopen(links[index])
    csv = response.read()

    csvstr = str(csv).strip("b'")

    lines = csvstr.split("\\n")
    f = open(names[index]+".csv", "w")
    f.write(names[index]+"."+lines[0][12:] + "\n")
    for line in lines[1:]:
       f.write(names[index]+","+line + "\n")
    f.close()
