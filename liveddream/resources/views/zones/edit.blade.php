@extends('layouts.app')
@section('content')
    <div class="content ">
       

        <form action="{{ route('zones.update', $zone->id) }}" method="POST">
            @csrf
            <div style="display:flex;flex-direction:row;gap:30%">
                <h2 class="mb-0">Edit Zone</h2>
                <button class="btn btn-primary btn-save" type="submit" id="zone">Update Zone</button>
            </div>
        <div class="row mt-3">
            <!-- Company Details -->
            
            <div class="card" style="width:60%"> <!-- Adjust width using Bootstrap class -->
                <div class="mb-5">
                    <h5>Zone Details</h5>
                    <div class="mt-4">
                        <label class="form-label">Zone Name</label>
                        <input type="text" name="name" value="{{ $zone->name }}"  class="form-control w-100" placeholder="Enter Zone name">
                    </div>
                    <div class="mt-4">
                        <label class="form-label">Coverage Area</label>
                        <input type="textarea" name="area" class="form-control w-100" value="{{ $zone->area }}" placeholder="remark">
                         <!-- <textarea name="" id="" cols="30" rows="10" placeholder="remark"></textarea> -->
                    </div>
                </div>
            </div>

            
            <!-- Godown & Sales Details -->
         
        </div>
    </form>

      
    </div>
@endsection
