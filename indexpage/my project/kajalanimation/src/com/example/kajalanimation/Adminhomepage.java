package com.example.kajalanimation;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OptionalDataException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.zip.Inflater;

import org.json.JSONObject;

import android.os.AsyncTask;
import android.os.Bundle;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

public class Adminhomepage extends Activity {
	
	EditText ed1;
	TextView t1;
	String en;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_adminhomepage);
		t1=(TextView)findViewById(R.id.t1);
		ed1=(EditText)findViewById(R.id.ed1);
	}
	public void search(View v)
	{
		String str;
		str=ed1.getText().toString();
		Toast.makeText(getApplicationContext(), str, 1000).show();
		try{
			
    		String d=URLEncoder.encode("key","UTF-8")+"="+URLEncoder.encode(str, "UTF-8");
			javadb z=new javadb();
			z.execute(d);			
		}
		catch(Exception e){
			
		}
	}
	@Override
	public boolean onCreateOptionsMenu(Menu m) {
		super.onCreateOptionsMenu(m);
		//getMenuInflater().inflate(R.menu.main, m);
		MenuItem m1=m.add(0,0,0,"issueBook");
		MenuItem m2=m.add(0,1,1,"ReturnBook");
		MenuItem m3=m.add(0,2,2,"Logout");
		return true;
	}
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		int id=item.getItemId();
		RelativeLayout r=(RelativeLayout)findViewById(R.id.r1);
		if(id==0)
		{
			r.setBackgroundColor(Color.RED);
			return true;
		}
		else if(id==1)
		{
			r.setBackgroundColor(Color.GRAY);
			return true;
		}
		else if(id==2)
		{
			SharedPreferences spf;
			spf = getSharedPreferences("myspf1", Context.MODE_PRIVATE);
			SharedPreferences.Editor ed = spf.edit();
			ed.putBoolean("a", false);
			ed.commit();
			
			
		}
		return false;
	}
	
    class javadb extends AsyncTask<String, Void, Void>
	{
		String msg="ddat";
		@Override
		protected Void doInBackground(String... arg0) {
			// TOD Auto-generated method stub
			try
			{
				URL u=new URL("http://10.0.2.2/test/1.php");
				HttpURLConnection con=(HttpURLConnection)u.openConnection();
				
				con.setRequestMethod("POST");
				OutputStream os=con.getOutputStream();
				os.write(arg0[0].getBytes());
	
				InputStream is=con.getInputStream();
				InputStreamReader isr=new InputStreamReader(is);
				BufferedReader br=new BufferedReader(isr);
				msg=br.readLine();
				
			}
			catch(Exception e)
			{
				msg=e.toString();
			}
			return null;
		}
		@Override
		protected void onPostExecute(Void result) {
			// TODO Auto-generated method stub
			t1.setText(msg);
			Toast.makeText(getApplicationContext(), msg, 1000).show();
			super.onPostExecute(result);
		}
	}
}
