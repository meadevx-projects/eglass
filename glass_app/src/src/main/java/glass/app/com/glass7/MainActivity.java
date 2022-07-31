package glass.app.com.glass7;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationManager;
import android.media.AudioManager;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.os.FileObserver;
import android.provider.MediaStore;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.glass.app.Card;
import com.google.android.glass.content.Intents;
import com.google.android.glass.touchpad.Gesture;
import com.google.android.glass.touchpad.GestureDetector;

import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.Date;

public class MainActivity extends Activity
{
    private GestureDetector mGestureDetector;
    public String TAG="NEWTAG";
    private AudioManager maManager;
    public double latitude;
    public double longitude;
    static int i=0;
    String picFileName=null;
    String mCurrentPhotoPath;
    ProgressDialog dialog = null;
    //final String uploadFilePath = "/storage/emulated/0/DCIM/Camera/";
    String uploadFilePath;
    //final String uploadFileName = "myPic.png";
    //final String uploadFileName = "te.txt";
    final String uploadFileName = "2.jpg";
    //final String upLoadServerUri = "http://eglass.arceon.bitnamiapp.com/api/api_upload_translation.php";
    final String upLoadServerUri = "http://eglass.arceon.bitnamiapp.com/api/api_upload_translation.php";
    String picturePath;
    int serverResponseCode = 0;
    //private static final int CAMERA_PIC_REQUEST = 1111;


    @Override
    protected void onCreate(Bundle savedInstanceState)
    {

        super.onCreate(savedInstanceState);
        LocationManager mlocManager = (LocationManager)getSystemService(getApplicationContext().LOCATION_SERVICE);

        // mlocManager.requestLocationUpdates( LocationManager.GPS_PROVIDER, 0, 0, mlocListener);
        //location = mlocManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
        findLocation(mlocManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER));
        //initialize the audio manager
        maManager = (AudioManager) getSystemService(this.AUDIO_SERVICE);
        //create gesture listener
        mGestureDetector = createGestureDetector(this);

        //create a new card for the view
        Card cView = new Card(this);
        //set the text of the card to the hello world string
        cView.setText(R.string.hello_world);
        //set the card as the content view
       // setContentView(cView.toView());


    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu)
    {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }


    public void findLocation(Location loc) {
        latitude = loc.getLatitude();
        longitude = loc.getLongitude();
        String Text = "Sending my current location Lat = " + latitude + " Long = " + longitude;
        Toast.makeText(getApplicationContext(), Text, Toast.LENGTH_SHORT).show();
        Log.i(null,Text,null);
        SendQueryString(); // for send the  Query String of latitude and logintude to the webapp.
    }

    public void SendQueryString() {
        new Thread() {
            public void run() {

                String url = "http://eglass.arceon.bitnamiapp.com/api/api_set_location.php?app_set_location_lat="+
                        latitude+"&app_set_location_long="+longitude;

                Log.i(null,url,null);
                Log.i(null,"** SENDING LOCATION DATA SEND **",null);

                try {
                    HttpClient Client = new DefaultHttpClient();
                    HttpGet httpget = new HttpGet(url);
                    Client.execute(httpget);

                }
                catch(Exception ex) {
                    String fail = "Fail!";
                   // Toast.makeText( getApplicationContext(),fail,Toast.LENGTH_SHORT).show();
                    Log.i(null,"** ERROR IN LOCATION DATA SEND **",null);
                }
            }
        }.start();
    }

    public void open() throws IOException {
        //Intent intent = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
        //startActivityForResult(intent, 0);

     /*   Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        // Ensure that there's a camera activity to handle the intent
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            // Create the File where the photo should go
            File photoFile = null;
            try {
                photoFile = createPictureFile();
            } catch (IOException ex) {
                // Error occurred while creating the File

            }


            String picturePath = takePictureIntent.getStringExtra(String.valueOf(photoFile));

            processPictureWhenReady(picturePath);

        }*/

        Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        startActivityForResult(intent, 1);




        }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == 1  && resultCode == RESULT_OK) {
            String thumbnailPath = data.getStringExtra(Intents.EXTRA_THUMBNAIL_FILE_PATH);
            picturePath = data.getStringExtra(Intents.EXTRA_PICTURE_FILE_PATH);

            Log.i(null,"PATH TILL NOW IS "+picturePath,null);
            processPictureWhenReady(picturePath);
            // TODO: Show the thumbnail to the user while the full picture is being
            // processed.
        }

        super.onActivityResult(requestCode, resultCode, data);
    }


    private void processPictureWhenReady(final String picturePath) {
            final File pictureFile = new File(picturePath);

            if (pictureFile.exists()) {
                // The picture is ready; process it.
            } else {
                // The file does not exist yet. Before starting the file observer, you
                // can update your UI to let the user know that the application is
                // waiting for the picture (for example, by displaying the thumbnail
                // image and a progress indicator).

                final File parentDirectory = pictureFile.getParentFile();
                FileObserver observer = new FileObserver(parentDirectory.getPath(),
                        FileObserver.CLOSE_WRITE | FileObserver.MOVED_TO) {
                    // Protect against additional pending events after CLOSE_WRITE
                    // or MOVED_TO is handled.
                    private boolean isFileWritten;

                    @Override
                    public void onEvent(int event, String path) {
                        if (!isFileWritten) {
                            // For safety, make sure that the file that was created in
                            // the directory is actually the one that we're expecting.
                            File affectedFile = new File(parentDirectory, path);
                            isFileWritten = affectedFile.equals(pictureFile);

                            if (isFileWritten) {
                                stopWatching();

                                // Now that the file is ready, recursively call
                                // processPictureWhenReady again (on the UI thread).
                                runOnUiThread(new Runnable() {
                                    @Override
                                    public void run() {
                                        processPictureWhenReady(picturePath);
                                    }
                                });
                            }
                        }
                    }
                };
                observer.startWatching();
            }




      /*      // Continue only if the File was successfully created
            if (photoFile != null) {
                takePictureIntent.putExtra(MediaStore.EXTRA_OUTPUT,
                        Uri.fromFile(photoFile));
                galleryAddPic();
                startActivityForResult(takePictureIntent, 0);

            }*/
        //}

    }

    private File createPictureFile()  throws IOException
    {

        // Create an image file name
        //String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String timeStamp = new SimpleDateFormat("HHmmss").format(new Date());
        String imageFileName = "JPEG_" + timeStamp + "_";
        File storageDir = Environment.getExternalStoragePublicDirectory(
                Environment.DIRECTORY_DCIM);
        File image = File.createTempFile(imageFileName,".jpg", storageDir);



        // Save a file: path for use with ACTION_VIEW intents
        mCurrentPhotoPath = "file:" + image.getAbsolutePath();
        Log.i(null,"PATH TILL NOW IS "+image.getPath(),null);
        picFileName=image.getPath();
        return image;

    }

    private void galleryAddPic() {
        Intent mediaScanIntent = new Intent(Intent.ACTION_MEDIA_SCANNER_SCAN_FILE);
        File f = new File(mCurrentPhotoPath);
        Uri contentUri = Uri.fromFile(f);
        mediaScanIntent.setData(contentUri);
        this.sendBroadcast(mediaScanIntent);
    }

    public void sendToServer()
    {
        TextView messageText;
        Button uploadButton;
        int serverResponseCode = 0;
        //ProgressDialog dialog = null;

        String upLoadServerUri = null;

        /**********  File Path *************/
        //final String uploadFilePath = "/mnt/sdcard/";
        //final String uploadFilePath = Environment.getExternalStorageDirectory().getPath();
        // String uploadFilePath = "/storage/emulated/0/DCIM/Camera/";
        //final String uploadFileName = "myPic.png";
        //final String uploadFileName = "te.txt";
        //final String uploadFileName = "2.jpg";
        //upLoadServerUri = "http://eglass.arceon.bitnamiapp.com/api/api_upload.php";

        //uploadButton.setOnClickListener(new OnClickListener() {
        //  @Override
        //public void onClick(View v) {

        dialog = ProgressDialog.show(MainActivity.this, "", "Uploading picture, please wait...", true);

        new Thread(new Runnable() {
            public void run() {
                runOnUiThread(new Runnable() {
                    public void run() {
                        //messageText.setText("uploading started.....");
                    }
                });

                //uploadFile(picFileName);
                  uploadFile(picturePath);

            }
        }).start();
        // }
        //});


    }


    public int uploadFile(String sourceFileUri) {


        //SystemClock.sleep(20000);
        try {
            Thread.sleep(20000);
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        String fileName = sourceFileUri;

        HttpURLConnection conn = null;
        DataOutputStream dos = null;
        String lineEnd = "\r\n";
        String twoHyphens = "--";
        String boundary = "*****";
        int bytesRead, bytesAvailable, bufferSize;
        byte[] buffer;
        int maxBufferSize = 1 * 1024 * 1024;

        //sourceFileUri="/storage/emulated/0/DCIM/1.jpg";
        File sourceFile = new File(sourceFileUri);
        //File sourceFile = new File("Users/basant/Downloads/te.txt");
        //if (!sourceFile.isFile()) {
        Log.i(null,"FILE AGAIN **"+sourceFileUri,null);

        double bytes = sourceFileUri.length();
        Log.e("**** size is ",String.valueOf(bytes));

        if(!sourceFile.exists()){

        //if(!sourceFile.isFile()){

            dialog.dismiss();

            Log.e("uploadFile", "Source File does not exist :"
                    +uploadFilePath + "" + uploadFileName);

            runOnUiThread(new Runnable() {
                public void run() {
                    //  messageText.setText("Source File not exist :"
                    //       +uploadFilePath + "" + uploadFileName);
                    //Toast.makeText(MainActivity.this, "Source file doesn't exist.",
                    //      Toast.LENGTH_SHORT).show();
                }
            });

            return 0;

        }
        else
        {
            try {

                // open a URL connection to the Servlet
                FileInputStream fileInputStream = new FileInputStream(sourceFile);
                URL url = new URL(upLoadServerUri);

                // Open a HTTP  connection to  the URL
                conn = (HttpURLConnection) url.openConnection();
                conn.setDoInput(true); // Allow Inputs
                conn.setDoOutput(true); // Allow Outputs
                conn.setUseCaches(false); // Don't use a Cached Copy
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Connection", "Keep-Alive");
                conn.setRequestProperty("ENCTYPE", "multipart/form-data");
                conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
                conn.setRequestProperty("uploaded_file", fileName);

                dos = new DataOutputStream(conn.getOutputStream());

                dos.writeBytes(twoHyphens + boundary + lineEnd);
                dos.writeBytes("Content-Disposition: form-data; name=\"imgfile\";filename=\"" + fileName + "" + lineEnd);

                dos.writeBytes(lineEnd);

                // create a buffer of  maximum size
                bytesAvailable = fileInputStream.available();

                bufferSize = Math.min(bytesAvailable, maxBufferSize);
                buffer = new byte[bufferSize];

                // read file and write it into form...
                bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                Log.e("Bytes read", String.valueOf(bytesRead));
                while (bytesRead > 0) {

                    dos.write(buffer, 0, bufferSize);
                    bytesAvailable = fileInputStream.available();
                    bufferSize = Math.min(bytesAvailable, maxBufferSize);
                    bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                }

                // send multipart form data necesssary after file data...
                dos.writeBytes(lineEnd);
                dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);

                // Responses from the server (code and message)
                serverResponseCode = conn.getResponseCode();
                String serverResponseMessage = conn.getResponseMessage();

                Log.i("uploadFile", "HTTP Response is : "
                        + serverResponseMessage + ": " + serverResponseCode);

                if(serverResponseCode == 200){

                    runOnUiThread(new Runnable() {
                        public void run() {

                            String msg = "File Upload Completed.\n\n See uploaded file here : \n\n"
                                    +upLoadServerUri
                                    +uploadFileName;

                            //Toast.makeText(MainActivity.this, msg,
                            //       Toast.LENGTH_SHORT).show();
                            //Toast.makeText(MainActivity.this, "File upload complete.",
                            //      Toast.LENGTH_SHORT).show();
                        }
                    });
                }

                //close the streams //
                fileInputStream.close();
                dos.flush();
                dos.close();
                conn.disconnect();

            } catch (MalformedURLException ex) {

                dialog.dismiss();
                ex.printStackTrace();

                runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(MainActivity.this, "Malformed URL exception.",
                                Toast.LENGTH_SHORT).show();

                    }
                });

                Log.e("Upload file to server", "error: " + ex.getMessage(), ex);
            } catch (Exception e) {

                //dialog.dismiss();
                e.printStackTrace();

                runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(MainActivity.this, "Got exception; see Logcat.",
                                Toast.LENGTH_SHORT).show();

                    }
                });
                Log.e("Upload file to server Exception", "Exception : "
                        + e.getMessage(), e);
            }
            dialog.dismiss();
            return serverResponseCode;

        } // End else block
    }
    private GestureDetector createGestureDetector(Context context){
        GestureDetector gestureDetector = new GestureDetector(context);
        //Create a base listener for generic gestures
        gestureDetector.setBaseListener( new GestureDetector.BaseListener() {

            @Override

            public boolean onGesture(Gesture gesture) {
                Log.e(TAG,"HELLOO ");
                Log.e(TAG,"gesture = " + gesture);
                switch (gesture) {
                    case TAP:
                        Log.d(TAG,"TAP called.");




                                if(i==0) {
                                    String Text = "Taking picture.. ";
                                    Toast.makeText(getApplicationContext(), Text, Toast.LENGTH_SHORT).show();

                                    i++;
                                    try {
                                        open();
                                    } catch (IOException e) {
                                        e.printStackTrace();
                                    }
                                    Toast.makeText(getApplicationContext(), "Tap twice to upload picture", Toast.LENGTH_LONG).show();
                                }
                                else
                                {
                                    Toast.makeText(getApplicationContext(), "Uploading picture", Toast.LENGTH_SHORT).show();
                                    sendToServer();
                                    i=0;
                                    //Toast.makeText(getApplicationContext(), "Tap to take another picture", Toast.LENGTH_LONG).show();
                                }


                        //handleGestureTap();
                        return true;
                        //break;
                   /* case LONG_PRESS:
                        Log.e(TAG,"LONG_PRESS called.");
                        return true;
                    case SWIPE_DOWN:
                        Log.e(TAG,"SWIPE_DOWN called.");
                        return true;
                    case SWIPE_LEFT:
                        Log.e(TAG,"SWIPE_LEFT called.");
                        return true;
                    case SWIPE_RIGHT:
                        Log.e(TAG,"SWIPE_RIGHT called.");
                        return true;
                    case SWIPE_UP:
                        Log.e(TAG,"SWIPE_UP called.");
                        return true;
                    case THREE_LONG_PRESS:
                        Log.e(TAG,"THREE_LONG_PRESS called.");
                        return true;
                    case THREE_TAP:
                        Log.e(TAG,"THREE_TAP called.");
                        return true;
                    case TWO_LONG_PRESS:
                        Log.e(TAG,"TWO_LONG_PRESS called.");
                        return true;
                    case TWO_SWIPE_DOWN:
                        Log.e(TAG,"TWO_SWIPE_DOWN called.");
                        return true;
                    case TWO_SWIPE_LEFT:
                        Log.e(TAG,"TWO_SWIPE_LEFT called.");
                        return true;
                    case TWO_SWIPE_RIGHT:
                        Log.e(TAG,"TWO_SWIPE_RIGHT called.");
                        return true;
                    case TWO_SWIPE_UP:
                        Log.e(TAG,"TWO_SWIPE_UP called.");
                        return true;
                    case TWO_TAP:
                        Log.e(TAG,"TWO_TAP called.");
                        return true;*/
                }

                return false;
            }
        });


        //handleGestureTap()
        gestureDetector.setFingerListener(new com.google.android.glass.touchpad.GestureDetector.FingerListener() {
            @Override
            public void onFingerCountChanged(int previousCount, int currentCount) {
                // do something on finger count changes
                Log.e(TAG,"onFingerCountChanged()");

            }
        });
        gestureDetector.setScrollListener(new com.google.android.glass.touchpad.GestureDetector.ScrollListener() {
            @Override
            public boolean onScroll(float displacement, float delta, float velocity) {
                // do something on scrolling
                Log.e(TAG,"onScroll()");
                return false;
            }
        });
        return gestureDetector;
    }



   /* private GestureDetector createGestureDetector(Context context)
    {
        GestureDetector gdDetector = new GestureDetector(context);
        //Create a base listener for generic gestures
        gdDetector.setBaseListener( new GestureDetector.BaseListener()
        {
            @Override
            public boolean onGesture(Gesture gesture)
            {
                if (gesture == Gesture.TAP)
                {
                    //play the tap sound
                    maManager.playSoundEffect(Sounds.TAP);
                    //open the menu
                    openOptionsMenu();
                    return true;
                }

                return false;
            }
        });

        return gdDetector;
    }*/

    @Override
    public boolean onGenericMotionEvent(MotionEvent event)
    {
        if (mGestureDetector != null)
            return mGestureDetector.onMotionEvent(event);

        return false;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item)
    {
        // Handle item selection. Menu items typically start another
        // activity, start a service, or broadcast another intent.
        switch (item.getItemId())
        {
            case R.id.share_menu_item:
                //do something on menu item click
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

}