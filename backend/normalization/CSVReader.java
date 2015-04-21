/**
 * Created by manu on 28/2/15.
 */
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class CSVReader {
    public static void read(String path) {
        BufferedReader br = null;
        try {
            String line = "";
            br = new BufferedReader(new FileReader(path));
            List<String> date = new ArrayList<String>();
            List<Double> oldOpen = new ArrayList<Double>();
			List<Double> oldHigh = new ArrayList<Double>();
			List<Double> oldLow = new ArrayList<Double>();            
			List<Double> oldClose = new ArrayList<Double>();
            while ((line = br.readLine()) != null) {
                String[] val = line.split(",");
                date.add(val[1]);
                oldOpen.add(Double.parseDouble(val[2]));
				oldHigh.add(Double.parseDouble(val[3]));
				oldLow.add(Double.parseDouble(val[4]));
				oldClose.add(Double.parseDouble(val[5]));
            }
            double []newOpen = new double[oldOpen.size()];
			double []newHigh = new double[oldHigh.size()];
			double []newLow = new double[oldLow.size()];
			double []newClose = new double[oldClose.size()];
            //Normalizing
            for(int i = 0; i < oldOpen.size() - 1; ++i) {
                newOpen[i] =(oldOpen.get(i) + oldOpen.get(i+1)) / 2.0;
				newHigh[i] =(oldHigh.get(i) + oldHigh.get(i+1)) / 2.0;
				newLow[i] =(oldLow.get(i) + oldLow.get(i+1)) / 2.0;
				newClose[i] =(oldClose.get(i) + oldClose.get(i+1)) / 2.0;
            }
            /*for(int i = 0; i < oldv.size() - 1; ++i) {
                System.out.println(oldv.get(i) + "  " + newv[i]);
            }*/
            CSVWriter.write("Normalized.csv",date,newOpen,newHigh,newLow,newClose);
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            if (br != null) {
                try {
                    br.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }
    }
}
