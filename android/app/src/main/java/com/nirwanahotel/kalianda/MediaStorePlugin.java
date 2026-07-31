package com.nirwanahotel.kalianda;

import android.content.ContentValues;
import android.net.Uri;
import android.os.Build;
import android.os.Environment;
import android.provider.MediaStore;

import com.getcapacitor.JSObject;
import com.getcapacitor.Plugin;
import com.getcapacitor.PluginCall;
import com.getcapacitor.PluginMethod;
import com.getcapacitor.annotation.CapacitorPlugin;

import java.io.OutputStream;
import java.util.Base64;

@CapacitorPlugin(name = "MediaStore")
public class MediaStorePlugin extends Plugin {

    @PluginMethod
    public void saveImage(PluginCall call) {

        String fileName = call.getString("fileName");
        String base64 = call.getString("base64");

        try {

            byte[] bytes;

            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
                bytes = Base64.getDecoder().decode(base64);
            } else {
                bytes = android.util.Base64.decode(base64, android.util.Base64.DEFAULT);
            }

            ContentValues values = new ContentValues();
            values.put(MediaStore.Images.Media.DISPLAY_NAME, fileName);
            values.put(MediaStore.Images.Media.MIME_TYPE, "image/jpeg");
            values.put(MediaStore.Images.Media.RELATIVE_PATH,
                    Environment.DIRECTORY_PICTURES + "/Nirwana Hotel");

            Uri uri = getContext().getContentResolver().insert(
                    MediaStore.Images.Media.EXTERNAL_CONTENT_URI,
                    values
            );

            OutputStream outputStream =
                    getContext().getContentResolver().openOutputStream(uri);

            outputStream.write(bytes);
            outputStream.flush();
            outputStream.close();

            JSObject ret = new JSObject();
            ret.put("success", true);

            call.resolve(ret);

        } catch (Exception e) {

            call.reject(e.getMessage());

        }

    }

}