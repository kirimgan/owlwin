<div id="students" class="list-group">
    @foreach ($students as $student)
        <div class="item  list-group-item col-xs-4 col-lg-4">
            <div class="row">
                {{--image--}}
                <div class="col-sm-2">
                    <img class="group list-group-image" width="100%" src="{{route('student.getPhoto', $student->photo)}}" alt="" />
                </div>

                {{--student info--}}
                <div class="col-sm-6">
                    <h4 class="group inner list-group-item-heading" style="color: #3C3C3D;">
                        <b>{{$student->firstName}} {{$student->lastName}}</b>
                        <?php
                        $showCompletedLabel = isset($alreadyInOfferCart) && $alreadyInOfferCart && !$student->is_available;
                        ?>
                        <span id="student_completed_lbl_{{ $student->id }}"
                              class="label label-danger @if(!$showCompletedLabel) hide @endif">
                                completed
                            </span>
                    </h4>
                    <p class="group inner list-group-item-text">{{$student->country}}</p>
                    <p class="group inner list-group-item-text">
                        <b>Age: </b> {{ getAgeByDateBirth($student->dateOfBirth) }}
                    </p>
                    @if($student->sponsor_name)
                        <p class="group inner list-group-item-text"><b>Sponsor:</b> {!! $student->sponsor_name !!}</p>
                    @endif
                    <p class="group inner list-group-item-text">
                        <div class="row">
                            <div class="col-md-2"><b>Availability: </b> </div>
                            <div class="col-md-10">{!! prepareDateForView($student->earliestDate) !!}<br>{!! prepareDateForView($student->latestDate) !!}</div>
                        </div>
                    </p>
                    <div class="student-list__buttons">
                        <a class="btn btn-success btn-sm visible-xs-inline"
                           href="{{ url('/student/view-pdf/' . $student->id)  }}">View Resume</a>
                        <a class="btn btn-success btn-sm js-view-pdf hidden-xs" target="_blank"
                           href="{{ url('/student/view-pdf/' . $student->id)  }}">View Resume</a>

                        @if(isset($alreadyInOfferCart) && $alreadyInOfferCart)
                            <a id="print_offer_{{$student->student_id}}" href="#"
                               class="btn btn-success btn-sm js-print-job-offer @if(!$student->is_available) hide @endif"
                               data-offer_form="{{ $student->offer_form }}"
                               data-student-id="{{$student->student_id}}">
                                Print Job Offer
                            </a>
                            <a id="reprint_offer_{{$student->student_id}}" href="#"
                               class="btn btn-success btn-sm js-reprint-job-offer @if($student->is_available) hide @endif"
                               data-offer_form="{{ $student->offer_form }}"
                               data-student-id="{{$student->student_id}}">
                                Re-print offer
                            </a>
                            <a class="btn btn-danger btn-sm remove-from-offers @if($showCompletedLabel) hide @endif" data-student-id="{{$student->student_id}}" href="#">Remove From Offers</a>
                            <span id="btn_upload_sf_{{ $student->id  }}" class="btn btn-success btn-sm fileinput-button @if(!$showCompletedLabel) hide @endif">
                                    <span id="btn_upload_sf_{{ $student->offer_id }}">{{ ($student->signed_form) ? "Replace Signed Form" : "Upload Signed Form" }}</span>
                                    <input class="fileupload" type="file" name="formpdf" data-url="/offers/upload_signed_form/{{  $student->id }}">
                            </span>
                            <span id="signedPdf_{{ $student->offer_id }}">
                                @if($student->signed_form)
                                    <a class="btn btn-success btn-sm js-view-pdf" href="{{ url('/offers/signed/' . $student->offer_id)  }}">View Signed Form</a>
                                @endif
                            </span>
                        @else
                            <a class="btn btn-success btn-sm add-to-offers" data-student-id="{{$student->id}}" href="#">Add To Offer Cart</a>
                        @endif
                    </div>
                </div>

                {{--youtube block--}}
                <div class="col-sm-4">
                    @if($student->youtube_url)
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="{{ prepareYoutubeUrl($student->youtube_url)  }}" allowFullScreen></iframe>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>