/**
 * Created by manu on 28/2/15.
 */
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
public class CSVWriter {
    private static final String COMMA_DELIMITER = ",";
    private static final String NEW_LINE_SEPARATOR = "\n";
    private static final String FILE_HEADER = "Date,Open,High,Low,Close";
    public static void write(String fileName, List<String> date, double []open, double []high, double []low, double []close) {
        FileWriter fileWriter = null;
        try {
            fileWriter = new FileWriter(fileName);
            fileWriter.append(FILE_HEADER.toString());

            //Add a new line separator after the header
            fileWriter.append(NEW_LINE_SEPARATOR);

            for (int i = 0; i < open.length; ++i) {
                fileWriter.append(date.get(i));
                fileWriter.append(COMMA_DELIMITER);
                fileWriter.append(String.valueOf(open[i]));
                fileWriter.append(COMMA_DELIMITER);
				fileWriter.append(String.valueOf(high[i]));
                fileWriter.append(COMMA_DELIMITER);
				fileWriter.append(String.valueOf(low[i]));
                fileWriter.append(COMMA_DELIMITER);
				fileWriter.append(String.valueOf(close[i]));
                fileWriter.append(NEW_LINE_SEPARATOR);
            }

            System.out.println("CSV file was created successfully !!!");

        } catch (Exception e) {
            System.out.println("Error in CsvFileWriter !!!");
            e.printStackTrace();
        } finally {

            try {
                fileWriter.flush();
                fileWriter.close();
            } catch (IOException e) {
                System.out.println("Error while flushing/closing fileWriter !!!");
                e.printStackTrace();
            }

        }
    }
}
