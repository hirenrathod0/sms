package com.example.kajalanimation;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

import android.os.AsyncTask;


public class javadb extends AsyncTask<Void, Void, Void>
{
	String msg;
	@Override
	protected Void doInBackground(Void... arg0) {
		// TOD Auto-generated method stub
		try
		{
			URL u=new URL("http://10.0.2.2/test/1.php");
			HttpURLConnection con=(HttpURLConnection)u.openConnection();
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
		super.onPostExecute(result);
	}

}
