package com.nirwanahotel.kalianda;

import android.util.Log;
import android.content.ContentValues;
import android.net.Uri;
import android.os.Build;
import android.os.Environment;
import android.provider.MediaStore;
import android.util.Base64;

import androidx.annotation.Nullable;

import com.getcapacitor.JSObject;
import com.getcapacitor.Plugin;
import com.getcapacitor.PluginCall;
import com.getcapacitor.PluginMethod;
import com.getcapacitor.annotation.CapacitorPlugin;

import java.io.OutputStream;

@CapacitorPlugin(name = "MediaStore")
public class MediaStorePlugin extends Plugin {

    @PluginMethod
    public void saveImage(PluginCall call) {
        Log.d("FATURR", "saveImage() DIPANGGIL");

        String fileName = call.getString("fileName");
        Log.d("FATURR", "fileName = " + fileName);
        String base64 = call.getString("base64");
        Log.d("FATURR", "base64 null ? " + (base64 == null));

        if (base64 != null) {
            Log.d("FATURR", "base64 length = " + base64.length());
        }

        if (fileName == null || base64 == null) {
            call.reject("fileName atau base64 kosong");
            return;
        }

        try {

            // Hilangkan prefix kalau masih ada
            if (base64.startsWith("data:image")) {
                base64 = base64.substring(base64.indexOf(",") + 1);
            }

            byte[] bytes = Base64.decode(base64, Base64.DEFAULT);

            ContentValues values = new ContentValues();
            values.put(MediaStore.Images.Media.DISPLAY_NAME, fileName);
            values.put(MediaStore.Images.Media.MIME_TYPE, "image/jpeg");

            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.Q) {
                values.put(
                        MediaStore.Images.Media.RELATIVE_PATH,
                        Environment.DIRECTORY_PICTURES + "/Nirwana Hotel");
            }

            Uri uri = getContext().getContentResolver().insert(
                    MediaStore.Images.Media.EXTERNAL_CONTENT_URI,
                    values);

            if (uri == null) {
                call.reject("Gagal membuat MediaStore URI");
                return;
            }

            OutputStream stream = getContext().getContentResolver().openOutputStream(uri);

            if (stream == null) {
                call.reject("OutputStream null");
                return;
            }

            stream.write(bytes);
            stream.flush();
            stream.close();

            JSObject ret = new JSObject();
            ret.put("success", true);
            ret.put("uri", uri.toString());

            call.resolve(ret);

        } catch (Exception e) {

            e.printStackTrace();

            JSObject error = new JSObject();
            error.put("message", e.getMessage());
            error.put("class", e.getClass().getName());

            call.reject(
                    "MediaStore saveImage failed",
                    error);

            Log.e("FATURR", "ERROR SAVE IMAGE", e);

        }

    }

}