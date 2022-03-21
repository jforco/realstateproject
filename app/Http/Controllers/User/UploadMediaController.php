<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Models\Media;
use App\Models\Publicacion;
use App\Models\Plan;
use Auth;

class UploadMediaController extends Controller
{
    
    public function storeImage($codigo, Request $request)
    {
        //validar
        $publicacion = Publicacion::where('codigo', $codigo)->firstOrFail();
        if(Auth::id() == $publicacion->id_usuario){
            $cant = Media::where('cod_publicacion', $codigo)->where('tipo', 'imagen')->count();
            $cantFotos = $publicacion->cant_fotos;
            if($cant < $cantFotos){
                $imagen_subida = $request->file;
                $random = Str::random(50);
                $imageName = $random.'.'.$imagen_subida->getClientOriginalExtension();
                
                //create and save thumbnail
                $imagenThumbnail = Image::make($imagen_subida);
                if($imagenThumbnail->height()<=$imagenThumbnail->width()){
                    $imagenThumbnail->crop($imagenThumbnail->height(), $imagenThumbnail->height());
                } else {
                    $imagenThumbnail->crop($imagenThumbnail->width(), $imagenThumbnail->width());
                }
                $imagenThumbnail->resize(200, 200);
                $direccion = 'publicaciones/thumbnails/'.$random.'-mini.'.$request->file->getClientOriginalExtension();
                
                //$imagen_subida->move(public_path('publicaciones'), $imageName);
                $imagen_subida->move('publicaciones', $imageName);
                $imagenThumbnail->save($direccion);

                $imagen = new Media();
                $imagen->nombre = $imageName;
                $imagen->original = $request->file->getClientOriginalName();
                $imagen->cod_publicacion = $codigo;
                $imagen->thumbnail = $direccion;
                $imagen->tipo = 'imagen';
                $imagen->save();

                return response($imagen->nombre, 200);
            }
            return response('Cantidad maxima excedida', 400);
        }
        return response('El usuario no tiene permitido subir fotos a una publicacion que no es de su propiedad', 400);
    }
    
    //destroy solo para dropzone
    public function destroy(Request $request)
    {
        $filename = $request->nombre_original;
        $media = Media::where('original', $filename)->first();
        if (empty($media)) {
            return Response::json(['message' => 'El archivo no existe'], 400);
        }
        $file_path = 'publicaciones/' . $media->nombre;
        $file_path2 = '' . $media->thumbnail;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        if (file_exists($file_path2)) {
            unlink($file_path2);
        }
        if (!empty($media)) {
            $media->delete();
        }
        if($request->is('eliminar_imagen')){
            return Response::json(['message' => 'Archivo eliminado exitosamente'], 200);
        } else {
            return redirect('anuncios/'.$media->cod_publicacion.'/editar');
        }
        
    }
    
}
