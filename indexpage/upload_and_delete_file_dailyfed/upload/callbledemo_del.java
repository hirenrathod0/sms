import java.util.*;
import java.sql.*;
class demo
{
	public static void main(String arg[]) throws Exception
	{
		Connection con;
		CallableStatement cs;
		Scanner sc=new Scanner(System.in);
		int a;
		String b,c;
		System.out.println("enter id:");
		a=sc.nextInt();
		
		Class.forName("com.mysql.jdbc.Driver");
		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/demo","root","");
		cs=con.prepareCall("{call deletePro(?)}");
		
		cs.setInt(1,a);
		
		
		int n=cs.executeUpdate();
		System.out.println("row deleted-->"+n);

	}
}
