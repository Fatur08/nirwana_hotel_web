package com.nirwanahotel.kalianda;

import android.Manifest;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.webkit.PermissionRequest;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;

import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.core.app.ActivityCompat;
import androidx.core.content.FileProvider;

import com.getcapacitor.Bridge;
import com.getcapacitor.BridgeActivity;

import com.nirwanahotel.kalianda.MediaStorePlugin;

import java.io.File;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class MainActivity extends BridgeActivity {

    private ValueCallback<Uri[]> fileUploadCallback;
    private Uri fotoKameraUri;

    private final ActivityResultLauncher<Intent> fileChooserLauncher = registerForActivityResult(
            new ActivityResultContracts.StartActivityForResult(),
            result -> {
                if (fileUploadCallback == null) {
                    return;
                }

                Uri[] hasil = null;

                if (result.getResultCode() == RESULT_OK) {

                    if (result.getData() != null && result.getData().getData() != null) {
                        // User memilih dari Galeri
                        hasil = new Uri[] { result.getData().getData() };

                    } else if (fotoKameraUri != null) {
                        // User mengambil foto dari Kamera
                        hasil = new Uri[] { fotoKameraUri };
                    }

                }

                fileUploadCallback.onReceiveValue(hasil);
                fileUploadCallback = null;
                fotoKameraUri = null;
            });

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        registerPlugin(MediaStorePlugin.class);

        // Minta izin Kamera secara runtime (wajib untuk Android 6.0+)
        ActivityCompat.requestPermissions(
                this,
                new String[] { Manifest.permission.CAMERA },
                1);

        Bridge bridge = getBridge();

        if (bridge != null) {

            WebView webView = bridge.getWebView();
            WebSettings settings = webView.getSettings();

            settings.setUseWideViewPort(true);
            settings.setLoadWithOverviewMode(true);

            settings.setSupportZoom(true);
            settings.setBuiltInZoomControls(true);
            settings.setDisplayZoomControls(false);

            settings.setDomStorageEnabled(true);
            settings.setJavaScriptCanOpenWindowsAutomatically(true);

            settings.setTextZoom(100);

            webView.setWebChromeClient(new WebChromeClient() {

                @Override
                public void onPermissionRequest(final PermissionRequest request) {
                    runOnUiThread(() -> request.grant(request.getResources()));
                }

                @Override
                public boolean onShowFileChooser(
                        WebView webView,
                        ValueCallback<Uri[]> filePathCallback,
                        FileChooserParams fileChooserParams) {

                    fileUploadCallback = filePathCallback;

                    // ==========================
                    // Intent Kamera
                    // ==========================
                    Intent intentKamera = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                    File fotoFile = buatFileFotoSementara();
                    Intent intentKameraFinal = null;

                    if (fotoFile != null) {
                        fotoKameraUri = FileProvider.getUriForFile(
                                MainActivity.this,
                                getApplicationContext().getPackageName() + ".fileprovider",
                                fotoFile);
                        intentKamera.putExtra(MediaStore.EXTRA_OUTPUT, fotoKameraUri);
                        intentKameraFinal = intentKamera;
                    }

                    // ==========================
                    // Intent Galeri
                    // ==========================
                    Intent intentGaleri = new Intent(Intent.ACTION_GET_CONTENT);
                    intentGaleri.addCategory(Intent.CATEGORY_OPENABLE);
                    intentGaleri.setType("image/*");

                    // ==========================
                    // Gabungkan jadi Chooser (Kamera + Galeri)
                    // ==========================
                    Intent chooser = Intent.createChooser(intentGaleri, "Pilih Sumber Gambar");

                    if (intentKameraFinal != null) {
                        chooser.putExtra(
                                Intent.EXTRA_INITIAL_INTENTS,
                                new Intent[] { intentKameraFinal });
                    }

                    fileChooserLauncher.launch(chooser);

                    return true;
                }

            });
        }
    }

    /**
     * Membuat file sementara di cache untuk menampung hasil foto kamera
     */
    private File buatFileFotoSementara() {
        try {
            String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss", Locale.getDefault()).format(new Date());
            String namaFile = "FOTO_" + timeStamp;
            File storageDir = getCacheDir();
            return File.createTempFile(namaFile, ".jpg", storageDir);
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }
}