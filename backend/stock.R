require(ggplot2)
library(rCharts)
library(forecast)
ms = read.csv("/home/nitin/Downloads/Normalized.csv",header = TRUE, sep=",",row.names=NULL,nrows=300)
#rearranging rows in proper order 
ms<-ms[rev(rownames(ms)),]
dates <- ms$Date
ms$Date <-as.Date(dates,"%d-%b-%y")
#creating timeseries object suitable for holtwinters function
v2 <- as.ts(ms$Value,ms$Date)
tot<-length(v2) 
fit <- HoltWinters(v2, gamma=FALSE)
one<-forecast(fit,25)
#generating sequence of dates for which prediction is to be made
ds<-seq( as.Date(ms$Date[tot]), by=1, len=26)
ds<-ds[2:length(ds)]
#data frame object with both future predictions and current stock values
quotes<-data.frame(c(ms$Date,ds),c(ms$Value,one$mean))
names(quotes)<-c("date","Value")
quotes<- transform(quotes,date = as.character(date))
k <- 5
cutoff <- 10

scores <- sapply(k:(length(v2)-k), FUN=function(i){
  left <- (v2[sapply(i-1:k, max, 1) ]<v2[i])*2-1
  right <- (v2[sapply(i+1:k, min, length(v2)) ]<v2[i])*2-1
  
  score <- abs(sum(left) + sum(right))
})
inflections <- (k:(length(v2)-k))[scores>=cutoff]
#function which generates html and javascript code  for interactive graph
m1<-mPlot(x="date",y="Value",type="Line",data=quotes)
m1$set(pointSize = 0, lineWidth = 1)
m1$save("amzn.html",standalone=TRUE)