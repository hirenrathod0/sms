import java.sql.*;
import java.util.*;
public class fourth
{
	public static void main(String str[])
	{
		try
		{
			PreparedStatement pps;
			Scanner sc=new Scanner(System.in);
			String name,psd;
			System.out.println("enter name:");
			name=sc.nextLine();
			psd=sc.nextLine();
			Connection con;
			Statement st;
			Class.forName("com.mysql.jdbc.Driver");
			con=DriverManager.getConnection("jdbc:mysql://localhost:3306/vivek","root","");
			pps=con.prepareStatement("insert into info values(?,?)");
			//String name="bbb",pass="456";
			pps.setString(1,name);
			pps.setString(2,psd);
			ResultSet rst;
			
			System.out.println(pps);
			int n=pps.executeUpdate();
			System.out.println("row inserted"+n);
			//rst.close();
			con.close();
			//st.close();
		}
		catch(Exception e)
		{
			e.printStackTrace();
		}
	}
}