import java.sql.*;
import java.util.*;
public class third
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
			pps=con.prepareStatement("select *from info where vname=? and vpass=?");
			//String name="bbb",pass="456";
			pps.setString(1,name);
			pps.setString(2,psd);
			ResultSet rst;
			
			System.out.println(pps);
			rst=pps.executeQuery();
			ResultSetMetaData rms=rst.getMetaData();
			int col=rms.getColumnCount();
			System.out.println("total cols="+col);
			int i;
			while(rst.next())
			{
				for(i=1;i<col;i++)
				{
				String n=rst.getString(1);
				String p=rst.getString(2);
			System.out.println(n+"\t"+p);
				}
			}
			rst.close();
			con.close();
			//st.close();
		}
		catch(Exception e)
		{
			e.printStackTrace();
		}
	}
}