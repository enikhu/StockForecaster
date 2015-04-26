require(ggplot2)
library(rCharts)
library(forecast)
args <- commandArgs(TRUE)
ms = read.csv(args[1],header = TRUE, sep=",",row.names=NULL,nrows=300)
#rearranging rows in proper order 
ms<-ms[rev(rownames(ms)),]
dates <- ms$Date
ms$Date <-as.Date(dates,"%d-%b-%y")
#creating timeseries object suitable for holtwinters function
v2 <- as.ts(ms$Value,ms$Date)
tot<-length(v2) 
fit <- HoltWinters(v2, gamma=FALSE)
one<-forecast(fit,30)
#generating sequence of dates for which prediction is to be made
ds<-seq( as.Date(ms$Date[tot]), by=1, len=31)
ds<-ds[2:length(ds)]
#data frame object with  future predictions
quotes<-data.frame(ds,one$mean)
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
coname<-unlist(strsplit(args[1], "[.]"))
newsconame<-gsub("Normalized","",coname)
newsconame<-paste(newsconame[1],"_news",sep="")
coname<-paste(coname[1],"html",sep=".")
ms<- transform(ms,Date = as.character(Date))

ms$tr<-FALSE
ms$tr[inflections]<-TRUE
news<-read.csv(newsconame,sep="\n",header=FALSE)
names(news)<-c("one")
#print(news)
#print(names(news))
ms$news<-"Nothing"
#print(news[1])
ms$news[inflections]<-as.vector(news$one)
#print(as.vector(news$one[3]))
print(length(news$one))
print(length(ms$news[inflections]))
setwd('/var/www/frontend/SE/')
m1<-mPlot(x="Date",y="Value",type="Line",data=ms)
m1$set(pointSize = 0, lineWidth = 1)
m1$set(hoverCallback = "#! function(index, options, content){
  var row = options.data[index]
  var res=row.news
  res=res.split('~')
  total=res.length
  news=''
  for(i=0;i<total-1;i++){
  	news=news+(i+1)+')'+res[i]+'</br>'
  }
      if(row.tr==true)
      {  
      return '<b>' + row.Date + '</b>' + '<br/>' +
      'Value: ' + row.Value + '<br/>'+
        'news:'+'<br/>'+news
      }
      else{
        return '<b>' + row.Date + '</b>' + '<br/>' +
      'Value: ' + row.Value + '<br/>'
      }
  
} !#")
m1$set(pointFillColors = c('red','green'))
m1$save(coname,standalone=TRUE)
coname<-paste("pred",coname[1],sep="")
#function which generates html and javascript code  for interactive graph
m2<-mPlot(x="date",y="Value",type="Line",data=quotes)
m2$set(pointSize = 0, lineWidth = 1)
m2$save(coname,standalone=TRUE)
