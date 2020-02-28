package com.example.kajalanimation;

import android.os.Bundle;
import android.app.Activity;
import android.app.backup.SharedPreferencesBackupHelper;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.view.Menu;
import android.view.View;
import android.widget.Toast;

public class Login extends Activity {
	SharedPreferences s;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_login);
		
		s=getSharedPreferences("myspf1", Context.MODE_PRIVATE);
		
		boolean data = s.getBoolean("a", false);
		
		Toast.makeText(this, ""+data, 1000).show();
		if(data==true)
		{
			Intent i=new Intent(this,Adminhomepage.class);
			startActivity(i);
			finish();
		}		
	}
		public void login(View v)
		{	
			SharedPreferences spf;
			spf = getSharedPreferences("myspf1", Context.MODE_PRIVATE);
			SharedPreferences.Editor ed = spf.edit();
			ed.putBoolean("a", true);
			ed.commit();
			
			boolean p = spf.getBoolean("a", false);
			Toast.makeText(this, ""+p, 1000).show();
			
			Intent i=new Intent(this,Adminhomepage.class);
			startActivity(i);		
			finish();
		}
}