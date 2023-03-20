<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\Profile\UpdateDetailUserRequest;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DetailUser;
use App\Models\ExperienceUser;
use Illuminate\View\View;

class ProfileController extends Controller
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
        $user = User::where('id', Auth::user()->id)->first();
        $experience_user = ExperienceUser::where('detail_user_id', $user->detail_user->id)
                                            ->orderBy('id', 'asc')
                                            ->get();

        return view('pages.dashboard.profile', compact('user', 'experience_user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404);
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
    public function edit(string $id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request_profile, UpdateDetailUserRequest $request_detail_user, )
    {
        $data_profile       = $request_profile->all();
        $data_detail_user   = $request_detail_user->all();

        $current_photo = DetailUser::where('user_id', Auth::user()->id)->first()->photo;
        // dd($current_photo);

        // check request photo
        if ($request_detail_user->photo) {
            // dd($request_detail_user->photo);

            // delete old image
            if (Storage::exists($current_photo)) {
                Storage::delete($current_photo);
            }

            $data_detail_user['photo'] = $request_detail_user->file('photo')->store('public/photo-profile');
        }

        // Save to User Table
        $user = User::find(Auth::user()->id);
        $user->update($data_profile);

        // Save to Detail User
        $detail_user = DetailUser::find($user->detail_user->id);
        $detail_user->update($data_detail_user);

        // Save to Experience User
        $experience_user_id = ExperienceUser::where('detail_user_id', $user->detail_user['id'])->first();
        if(isset($experience_user_id)) {

            foreach ($data_profile['experience'] as $key => $value) {
                $experience_user = ExperienceUser::find($key);
                $experience_user->detail_user_id = $detail_user['id'];
                $experience_user->experience = $value;
                $experience_user->save();
            }

        } else {

            foreach ($data_profile['experience'] as $key => $value) {

                if(isset($value)) {
                    $experience_user = new ExperienceUser;
                    $experience_user->detail_user_id = $detail_user['id'];
                    $experience_user->experience = $value;
                    $experience_user->save();
                }
            }

        }

        toast()->success('Data has been updated', 'success');

        // Alert::success('Success', 'Data has been updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }


    public function delete()
    {
        // get user
        $get_user_photo = DetailUser::where('user_id', Auth::user()->id)->first();
        $path_photo = $get_user_photo['photo'];
        // dd($path_photo);

        // second update to null
        $data = DetailUser::find($get_user_photo['id']);
        $data->photo = NULL;
        $data->save();

        // delete file photo
        $data = 'storage/' . $path_photo;
        if (Storage::exists($data)) {
            Storage::delete($data);
        } else {
            Storage::delete('storage/app/public/' . $path_photo);
        }

        toast()->success('Delete has been success');
        return back();
        
    }
}
