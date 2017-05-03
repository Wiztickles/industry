@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Edit Profile</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/profile/edit/'.$user->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" placeholder="John" value="{{ old('first_name',$user->first_name) }}">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Smith" value="{{ old('last_name',$user->last_name) }}">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email',$user->email) }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                            <label for="skills" class="col-md-4 control-label">Skills</label>

                            <div class="col-md-6">
                                <input id="skills" type="text" class="form-control" name="skills" placeholder="e.g. Builder" value="{{ old('skills',$user->skills) }}">

                                @if ($errors->has('skills'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                            <label for="bio" class="col-md-4 control-label">Bio</label>

                            <div class="col-md-6">
                            <textarea id="bio" name="bio" class="form-control" rows="5" placeholder="Tell us about Yourself">{{ old('bio',$user->bio) }}</textarea>

                                @if ($errors->has('bio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="tel" class="form-control" name="phone_number" placeholder="021123456" value="{{ old('phone_number',$user->phone_number) }}">

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group{{ $errors->has('recive_text_updates') ? ' has-error' : '' }}">
                            <label for="recive_text_updates" class="col-md-4 control-label">Recive Text Updates</label>

                            <div class="col-md-6">
                                <input id="recive_text_updates" type="hidden" class="" name="recive_text_updates" value="0">
                                @if ($user->recive_text_updates === 0)
                                    <input id="recive_text_updates" type="checkbox" class="" name="recive_text_updates" value="1">
                                @else
                                    <input id="recive_text_updates" type="checkbox" class="" name="recive_text_updates" value="1" checked>
                                @endif
                                @if ($errors->has('recive_text_updates'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('recive_text_updates') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <span>Leave File Blank if you want to use existing avatar</span>
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">Choose Avatar</label>

                            <div class="col-md-6">
                                <input type="file" name="avatar" id="avatar">
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-gear"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
