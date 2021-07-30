<form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Image : </label>
        <input type="file" name="files[]" class="form-control" multiple>
    </div>
    <input type="submit" class="btn btn-info">
</form>



Route::post('upload',[UserController::class,'upload'])->name('upload');




    function upload(Request $request)
    {
        if ($request->hasfile('files')) 
        {
            foreach ($request->file('files') as $file) 
            {
                $name = time().$file->getClientOriginalName();
                $file->move(public_path() . '/image/', $name);
                // $data[] = $name;
                $data=DB::table("upload")->insert([
                    "file"=>$name
                ]);

            }
        }
        return redirect(route('index'));

    }
