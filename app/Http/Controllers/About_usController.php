<?php

namespace App\Http\Controllers;
use App\About;
use App\AboutTranslation;
use App\Client_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class About_usController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $items = AboutTranslation::query();
        if ($request->has('title')){
            $abouts = $items->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('description')){
            $abouts = $items->where('description', 'like', '%' . $request->input('description') . '%');
        }

        $items = $items->where('locale', app()->getLocale())->paginate(5);
        return view('abouts.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('abouts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //App::getLocale();
        $request->validate($this->rules(), $this->messages());
        $abouts_data = [];
        $abouts_data['en'] = [
            'title' => $request->en_title,
            'description' => $request->en_description,
        ];
        $abouts_data['ar'] = [
            'title' => $request->ar_title,
            'description' => $request->ar_description,
        ];

//        dd($request->file('about_us_image'));

        $about= About::create($abouts_data);
        $about->image= parent::uploadImage($request->file('about_us_image'));

        if ($about->save()){
            return redirect()->back()->with('success', trans('about.success.stored'));
        }
        else
            return redirect()->back()->with('error', trans('about.error.stored'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('abouts.show', [
            'about' => About::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $about = About::findOrFail($id);
            $request->validate($this->rules($id), $this->messages());

            $abouts_data = [];
            $abouts_data['en'] = [
                'title' => $request->en_title,
                'description' => $request->en_description,
            ];
            $abouts_data['ar'] = [
                'title' => $request->ar_title,
                'description' => $request->ar_description,
            ];
            if($request->file('about_us_image')){
                $about->image= parent::uploadImage($request->file('about_us_image'));
            }
            $about->update($abouts_data);
            return redirect()->back()->with('success', trans('about.success.updated'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return redirect()->back()->with('error', trans('about.error.updated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $about = About::findOrFail($id);
            $about->delete();

//            return response()->json(['status' => 200, 'message' => trans('about.success.deleted')]);
            return redirect()->back()->with('success', trans('about.success.deleted'));
        } catch (ModelNotFoundException $modelNotFoundException) {
//            return response()->json(['status' => 200, 'message' => trans('about.error.deleted')]);
            return redirect()->back()->with('error', trans('about.error.deleted'));
        }
    }

    private function rules($id = null)
    {
        $rules = [
            'en_title' => 'required|max:100',
            'ar_title' => 'required|max:100',
            'en_description' => 'required',
            'ar_description' => 'required',
            'about_image' => 'image',
        ];
        if (!$id) {
            $rules['about_image'] = 'image';
        }
        return $rules;
    }

    /**
     *
     * validation's messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'en_title.required' => trans('about.validations.title_required'),
            'en_title.max' => trans('about.validations.title_max'),
            'en_description.required' => trans('about.validations.description_required'),
            'ar_title.required' => trans('about.validations.title_required'),
            'ar_title.max' => trans('about.validations.title_max'),
            'ar_description.required' => trans('about.validations.description_required'),
        ];
    }
}
