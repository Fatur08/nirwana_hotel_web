package com.nirwanahotel.kalianda;

import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;

import com.getcapacitor.Bridge;
import com.getcapacitor.BridgeActivity;

public class MainActivity extends BridgeActivity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        Bridge bridge = getBridge();

        if (bridge != null) {

            WebView webView = bridge.getWebView();
            WebSettings settings = webView.getSettings();

            settings.setUseWideViewPort(true);
            settings.setLoadWithOverviewMode(true);

            settings.setSupportZoom(true);
            settings.setBuiltInZoomControls(false);
            settings.setDisplayZoomControls(false);

            settings.setDomStorageEnabled(true);
            settings.setJavaScriptCanOpenWindowsAutomatically(true);

            settings.setTextZoom(100);
        }
    }
}