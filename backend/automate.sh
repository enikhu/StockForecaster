#! /bin/bash
cd /var/www/backend
python3 csv_scrape.py 
python3 Finance.py
for file in  Intel.csv Microsoft.csv Amazon.csv
do
	java Main $file
done
for file in  NormalizedIntel.csv NormalizedMicrosoft.csv NormalizedAmazon.csv
do
	Rscript inflections.R $file
done
for file in Intel Microsoft Amazon
do
	php getNews.php $file
done
for file in  NormalizedIntel.csv NormalizedMicrosoft.csv NormalizedAmazon.csv
do
	Rscript stock.R $file 
	Rscript new_algo.r $file
done
