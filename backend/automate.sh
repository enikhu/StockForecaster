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
	Rscript /var/www/backend/inflections.R $file
	Rscript /var/www/backend/stock.R $file 
	Rscript /var/www/backend/new_algo.r $file
done

