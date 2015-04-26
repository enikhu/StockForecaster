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
            List<Double> oldv = new ArrayList<Double>();
            //line=br.readLine();
            while ((line = br.readLine()) != null) {
                String[] val = line.split(",");
                //System.out.println(val.length);
                if((val.length!=1)&&(!val[1].equals("Open"))){
               		//System.out.println(val[1]);
                	date.add(val[1]);
                	oldv.add(Double.parseDouble(val[2]));
                	}
            }
            double []newv = new double[oldv.size()];
            //Normalizing
            for(int i = 0; i < oldv.size() - 1; ++i) {
                newv[i] =(oldv.get(i) + oldv.get(i+1)) / 2.0;
            }
            /*for(int i = 0; i < oldv.size() - 1; ++i) {
                System.out.println(oldv.get(i) + "  " + newv[i]);
            }*/
            CSVWriter.write("Normalized"+path,date,newv);
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
