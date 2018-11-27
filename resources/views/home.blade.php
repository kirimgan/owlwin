@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 style="color: #3C3C3D;"><b><?php echo auth()->user()->company_info; ?></b></h2>
        <h4 style="margin-bottom: 30px;"><?php echo auth()->user()->address; ?></h4>
        <!-- Nav tabs -->
        <ul class="nav nav-pills" role="tablist" id="studentTabs">
            <li role="presentation" class="active">
                <a href="#students-tab" aria-controls="students-tab" role="tab" data-toggle="tab">
                    Participants <span id="students_total" class="badge">{{ $students->total()  }}</span>
                </a>
            </li>
            <li role="presentation">
                <a id="tab_completed" href="#offer-cart" aria-controls="profile" role="tab" data-toggle="tab">
                    Offer Cart <span id="active_offers_count" class="badge">{{ $activeOffersCount  }}</span>
                </a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div id="offer_tabs" class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="students-tab">
                @include('blocks.students-list-with-links')
            </div>

            <div role="tabpanel" class="tab-pane" id="offer-cart">
            </div>

        </div>
    </div>
    @include('blocks.modal_pdf')
@endsection

@section('js-files')
    <script src="/js/file_upload/jquery.ui.widget.js"></script>
    <script src="/js/file_upload/jquery.iframe-transport.js"></script>
    <script src="/js/file_upload/jquery.fileupload.js"></script>
@endsection