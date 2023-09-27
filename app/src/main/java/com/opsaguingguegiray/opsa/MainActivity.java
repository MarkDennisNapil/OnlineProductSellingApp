package com.opsaguingguegiray.opsa;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.Menu;
import android.view.View;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ProgressBar;
import android.webkit.WebSettings; 
import android.webkit.WebStorage; 
import android.webkit.CookieManager; 
import android.webkit.WebSettings;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Build;
import android.os.Environment;
import android.os.Parcelable;
import android.provider.MediaStore;
import android.util.Log;
import android.webkit.ValueCallback;
import android.widget.Toast;
import java.io.File;
import java.io.IOException;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Build;
import android.os.Environment;
import android.os.Parcelable;
import android.provider.MediaStore;
import android.util.Log;
import android.webkit.ValueCallback;
import android.widget.Toast;
import java.io.File;
import java.io.IOException;

//import class for Uploading part End 

public class MainActivity extends Activity {
    private WebView web;
    String webUrl = "http://localhost:8080/";
	private ProgressBar progressBar;

    public Context context;

    private static final String TAG = MainActivity.class.getSimpleName();

    private static final int FILECHOOSER_RESULTCODE = 1;
    private ValueCallback<Uri> mUploadMessage;
    private Uri mCapturedImageURI = null;

    // the same for Android 5.0 methods only
    private ValueCallback<Uri[]> mFilePathCallback;
    private String mCameraPhotoPath;

	@SuppressLint("SetJavaScriptEnabled") 
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
		//Cookies and etc
		progressBar = (ProgressBar) findViewById(R.id.progressBar);
		progressBar.setMax(100);
		web = (WebView) findViewById(R.id.web_view);
		web.setWebViewClient(new WebViewClientSite());
		web.setWebChromeClient(new WebChromeClientSite());
		WebSettings settings = web.getSettings();
		settings.setJavaScriptEnabled(true);
		settings.setDomStorageEnabled(true); 
		settings.setDatabaseEnabled(true); 

		CookieManager.getInstance();

        web = (WebView) findViewById(R.id.web_view);
        web.loadUrl(webUrl);

        WebSettings mywebsettings = web.getSettings();
        mywebsettings.setJavaScriptEnabled(true);



//improve webview performance
        

//enable upload part

        web.setWebChromeClient(new WebChromeClientSite() {
				// for Lollipop, all in one
				public boolean onShowFileChooser(
                    WebView webView, ValueCallback<Uri[]> filePathCallback,
                    WebChromeClient.FileChooserParams fileChooserParams) {
					if (mFilePathCallback != null) {
						mFilePathCallback.onReceiveValue(null);
					}
					mFilePathCallback = filePathCallback;

					Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
					if (takePictureIntent.resolveActivity(getPackageManager()) != null) {

						// create the file where the photo should go
						File photoFile = null;
						try {
							photoFile = createImageFile();
							takePictureIntent.putExtra("PhotoPath", mCameraPhotoPath);
						} catch (IOException ex) {
							// Error occurred while creating the File
							Log.e(TAG, "Unable to create Image File", ex);
						}

						// continue only if the file was successfully created
						if (photoFile != null) {
							mCameraPhotoPath = "file:" + photoFile.getAbsolutePath();
							takePictureIntent.putExtra(MediaStore.EXTRA_OUTPUT,
													   Uri.fromFile(photoFile));
						} else {
							takePictureIntent = null;
						}
					}

					Intent contentSelectionIntent = new Intent(Intent.ACTION_GET_CONTENT);
					contentSelectionIntent.addCategory(Intent.CATEGORY_OPENABLE);
					contentSelectionIntent.setType("image/*");

					Intent[] intentArray;
					if (takePictureIntent != null) {
						intentArray = new Intent[]{takePictureIntent};
					} else {
						intentArray = new Intent[0];
					}

					Intent chooserIntent = new Intent(Intent.ACTION_CHOOSER);
					chooserIntent.putExtra(Intent.EXTRA_INTENT, contentSelectionIntent);
					chooserIntent.putExtra(Intent.EXTRA_TITLE, getString(R.string.image_chooser));
					chooserIntent.putExtra(Intent.EXTRA_INITIAL_INTENTS, intentArray);

					startActivityForResult(chooserIntent, FILECHOOSER_RESULTCODE);

					return true;
				}

				// creating image files (Lollipop only)
				private File createImageFile() throws IOException {

					File imageStorageDir = new File(Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES), "DirectoryNameHere");

					if (!imageStorageDir.exists()) {
						imageStorageDir.mkdirs();
					}

					// create an image file name
					imageStorageDir = new File(imageStorageDir + File.separator + "IMG_" + String.valueOf(System.currentTimeMillis()) + ".jpg");
					return imageStorageDir;
				}

				// openFileChooser for Android 3.0+
				public void openFileChooser(ValueCallback<Uri> uploadMsg, String acceptType) {
					mUploadMessage = uploadMsg;

					try {
						File imageStorageDir = new File(Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES), "DirectoryNameHere");

						if (!imageStorageDir.exists()) {
							imageStorageDir.mkdirs();
						}

						File file = new File(imageStorageDir + File.separator + "IMG_" + String.valueOf(System.currentTimeMillis()) + ".jpg");

						mCapturedImageURI = Uri.fromFile(file); // save to the private variable

						final Intent captureIntent = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
						captureIntent.putExtra(MediaStore.EXTRA_OUTPUT, mCapturedImageURI);
						// captureIntent.putExtra(MediaStore.EXTRA_SCREEN_ORIENTATION, ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);

						Intent i = new Intent(Intent.ACTION_GET_CONTENT);
						i.addCategory(Intent.CATEGORY_OPENABLE);
						i.setType("image/*");

						Intent chooserIntent = Intent.createChooser(i, getString(R.string.image_chooser));
						chooserIntent.putExtra(Intent.EXTRA_INITIAL_INTENTS, new Parcelable[]{captureIntent});

						startActivityForResult(chooserIntent, FILECHOOSER_RESULTCODE);
					} catch (Exception e) {
						Toast.makeText(getBaseContext(), "Camera Exception:" + e, Toast.LENGTH_LONG).show();
					}

				}

				// openFileChooser for Android < 3.0
				public void openFileChooser(ValueCallback<Uri> uploadMsg) {
					openFileChooser(uploadMsg, "");
				}

				// openFileChooser for other Android versions
				/* may not work on KitKat due to lack of implementation of openFileChooser() or onShowFileChooser()
				 https://code.google.com/p/android/issues/detail?id=62220
				 however newer versions of KitKat fixed it on some devices */
				public void openFileChooser(ValueCallback<Uri> uploadMsg, String acceptType, String capture) {
					openFileChooser(uploadMsg, acceptType);
				}

			});
    }



    // return here when file selected from camera or from SD Card
    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {

        // code for all versions except of Lollipop
        if (Build.VERSION.SDK_INT < Build.VERSION_CODES.LOLLIPOP) {

            if (requestCode == FILECHOOSER_RESULTCODE) {
                if (null == this.mUploadMessage) {
                    return;
                }

                Uri result = null;

                try {
                    if (resultCode != RESULT_OK) {
                        result = null;
                    } else {
                        // retrieve from the private variable if the intent is null
                        result = data == null ? mCapturedImageURI : data.getData();
                    }
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), "activity :" + e, Toast.LENGTH_LONG).show();
                }

                mUploadMessage.onReceiveValue(result);
                mUploadMessage = null;
            }

        } // end of code for all versions except of Lollipop

        // start of code for Lollipop only
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {

            if (requestCode != FILECHOOSER_RESULTCODE || mFilePathCallback == null) {
                super.onActivityResult(requestCode, resultCode, data);
                return;
            }

            Uri[] results = null;

            // check that the response is a good one
            if (resultCode == Activity.RESULT_OK) {
                if (data == null || data.getData() == null) {
                    // if there is not data, then we may have taken a photo
                    if (mCameraPhotoPath != null) {
                        results = new Uri[]{Uri.parse(mCameraPhotoPath)};
                    }
                } else {
                    String dataString = data.getDataString();
                    if (dataString != null) {
                        results = new Uri[]{Uri.parse(dataString)};
                    }
                }
            }

            mFilePathCallback.onReceiveValue(results);
            mFilePathCallback = null;

        } // end of code for Lollipop only


    }
	private class WebViewClientSite extends WebViewClient {
		@Override
		public boolean shouldOverrideUrlLoading(WebView view, String url) {
			view.loadUrl(url);
			return true;
		}
		@Override
		public void onPageFinished(WebView view, String url) {
			super.onPageFinished(view, url);
			progressBar.setVisibility(View.GONE);
			progressBar.setProgress(100);
		}
		@Override
		public void onPageStarted(WebView view, String url, Bitmap favicon) {
			super.onPageStarted(view, url, favicon);
			progressBar.setVisibility(View.VISIBLE);
			progressBar.setProgress(0);
		}       
	}
	private class WebChromeClientSite extends WebChromeClient {
		public void onProgressChanged(WebView view, int progress) {
			progressBar.setProgress(progress);
		}
	}

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
		if ((keyCode == KeyEvent.KEYCODE_BACK) && web.canGoBack()) {
			web.goBack();
			return true;
		}
		else {
			finish();
		}
		return super.onKeyDown(keyCode, event);
	}
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		return true;
	}
}  
