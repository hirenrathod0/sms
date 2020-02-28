package com.example.kajalanimation;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;

public class MainActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Runnable r=new Runnable() {
			
			@Override
			public void run() {
				try{
			        Thread.sleep(5000);
			        finish();
			        Intent i=new Intent(MainActivity.this,Login.class);
			        startActivity(i);
			        }
			        catch(Exception e){}
			    	
			}
		};
        Thread mt=new Thread(r);
        mt.start();
        
    
     }

   
}
