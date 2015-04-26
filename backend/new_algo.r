require(ggplot2)
library(rCharts)
  library(forecast)
  args <- commandArgs(TRUE)
  ms = read.csv(args[1],header = TRUE, sep=",",row.names=NULL)
  ms<-ms[rev(rownames(ms)),]
  dates <- ms$Date
  ms$Date <-as.Date(dates,"%d-%b-%y")
  print(length(ms$Value))
  v2 <- as.ts(ms$Value,ms$Date)
  
  #print(ms$Date)
  #plot(v2, type="l", col="darkblue")
 library(tseries)
 adf = adf.test(v2)
 if(p <- adf[4]$p.value > 0.05)
 {
   #non-stationary
   t <- ndiffs(v2)
   while(t)
   {
     t <- t-1
     v2 = diff(v2)
   }
 }
#stationary
 fit <- auto.arima(v2, seasonal=FALSE)
 #plot(forecast(fit,h=50))
  pred<-forecast(fit,h=50)
  tot<-length(ms$Date) 
  ds<-seq( as.Date(ms$Date[tot]), by=1, len=51)
  ds<-ds[2:length(ds)]
  print(ds)
  quotes<-data.frame(ds,pred$mean)
  names(quotes)<-c("date","Value")
  quotes<- transform(quotes,date = as.character(date))
setwd('/var/www/frontend/SE/')
coname<-unlist(strsplit(args[1], "[.]"))
#creating name of html file to be generated
coname<-paste(coname[1],"html",sep=".")
coname<-paste("pred1",coname[1],sep="")
  m3<-mPlot(x="date",y="Value",type="Line",data=quotes)
  m3$set(pointSize = 0, lineWidth = 1)
  m3$save(coname,standalone=TRUE)
