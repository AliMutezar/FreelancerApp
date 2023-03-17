<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use File;
use Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\AdvantageService;
use App\Models\AdvantageUser;
use App\Models\Tagline;
use App\Models\ThumbnailService;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $services = Service::where('user_id', Auth::user()->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('pages.dashboard.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // add to service
        $service = Service::create($data);

        // add to advantage service
        foreach ($data['advantage-service'] as $key => $value) {
            $advantage_service = new AdvantageService();
            $advantage_service->service_id = $service->id;
            $advantage_service->advantage_id = $value;
            $advantage_service->save();
        }

        // add to advantage user
        foreach ($data['advantage-user'] as $key => $value) {
            $advantage_service = new AdvantageUser();
            $advantage_service->service_id = $service->id;
            $advantage_service->advantage_id = $value;
            $advantage_service->save();
        }


        // add to thumbnail service
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $file) {
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service->id;
                $thumbnail_service->thumbnail = $value;
                $thumbnail_service->save();
            }
        }

        // add to taqline
        if(count($data['tagline'])) {
            foreach ($data['tagline'] as $key => $value) {
                $tagline = new Tagline;
                $tagline->service_id = $service->id;
                $tagline->tagline = $value;
                $tagline->save();
            }
        }

        toast()->success('Save has been success');
        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $advantage_service = AdvantageService::where('service_id', $service->id)->get();
        $tagline = Tagline::where('service_id', $service->id)->get();
        $advantage_user = AdvantageUser::where('service_id', $service->id)->get();
        $thumbnail_service = ThumbnailService::where('service_id', $service->id)->get();

        return view('pages.dashboard.service.edit', compact('advantage_service', 'tagline', 'advantage_user', 'thumbnail_service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->all();


        // update to service
        $service->update($data);

        // update to advantage service
        foreach ($data['advantage-service'] as $key => $value) {
            $advantage_service = AdvantageService::find($key);
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        // add new advantage service
        if (isset($data['advantage-service'])) {
            foreach ($data['advantage-service'] as $key => $value) {
                $advantage_service = AdvantageService::find($key);
                $advantage_service->service_id = $service->id;
                $advantage_service->advantage = $value;
                $advantage_service->save();
            }
        }

        // update to advantage user
        foreach ($data['advantage-user'] as $key => $value) {
            $advantage_user = AdvantageUser::find($key);
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        // add new advantage user
        if (isset($data['advantage-user'])) {
            foreach ($data['advantage-user'] as $key => $value) {
                $advantage_user = AdvantageUser::find($key);
                $advantage_user->service_id = $service->id;
                $advantage_user->advantage = $value;
                $advantage_user->save();
            }
        }

        // update to tagline
        foreach ($data['taqline'] as $key => $value) {
            $tagline = Tagline::find($key);
            $tagline->advantage = $value;
            $tagline->save();
        }

        // add new tagline
        if (isset($data['taqline'])) {
            foreach ($data['advantage-user'] as $key => $value) {
                $tagline = Tagline::find($key);
                $tagline->service_id = $service->id;
                $tagline->advantage = $value;
                $tagline->save();
            }
        }

        // update thumbnails service
        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $key => $file) 
            {
                // get old photo
                $get_old_photo = ThumbnailService::where('id', $key)->first();

                // store photo
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                // update thumbnail
                $thumbnail_service = ThumbnailService::find($key);
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();

                // delete old photo thumbnail
                $data = 'storage/' . $get_old_photo['photo'];
                if(File::exists($data)) {
                    File::delete($data);
                } else {
                    File::delete('storage/app/public/' . $get_old_photo['photo']);
                }
            }
        }

        // add to thumbnail service
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $file) {
                
                // store photo
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service->id;
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }
        }

        toast()->success('Update has been success');
        return redirect()->route('service.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }
}
