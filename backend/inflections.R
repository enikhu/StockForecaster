library(forecast)
args <- commandArgs(TRUE)
#reading file specified in commandline
ms = read.csv(args[1],header = TRUE, sep=",",row.names=NULL,nrows=300)
ms<-ms[rev(rownames(ms)),]
dates <- ms$Date
ms$Date <-as.Date(dates,"%d-%b-%y")
#v1 <- as.ts(ms$Value,start=c(2012,2),end=c(2015,1),frequency=1)
v2 <- as.ts(ms$Value,ms$Date)
k <- 5
cutoff <- 10

scores <- sapply(k:(length(v2)-k), FUN=function(i){
  left <- (v2[sapply(i-1:k, max, 1) ]<v2[i])*2-1
  right <- (v2[sapply(i+1:k, min, length(v2)) ]<v2[i])*2-1
  
  score <- abs(sum(left) + sum(right))
})

inflections <- (k:(length(v2)-k))[scores>=cutoff]
coname<-unlist(strsplit(args[1], "[.]"))
#creating name of inflection points file to be generated
coname<-gsub("Normalized","",coname)
#coname<-paste(coname[1],"txt",sep=".")
#print(coname[1])
file.create(coname[1])
fileConn<-file(coname[1])
points<-sapply(as.character(ms$Date[inflections]),FUN=function(i){
	val<-unlist(strsplit(i, "[-]"))
	val<-paste(val[1],val[2],val[3],sep="")
})
print(length(points))
writeLines(as.character(points), fileConn)
close(fileConn)
#print(inflections)
