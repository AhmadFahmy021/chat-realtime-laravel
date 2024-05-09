{{-- ---------------------- Image modal box ---------------------- --}}
<div id="imageModalBox" class="imageModal">
    <span class="imageModal-close">&times;</span>
    <img class="imageModal-content" id="imageModalBoxSrc">
</div>

{{-- ---------------------- Delete Modal ---------------------- --}}
<div class="app-modal" data-name="delete">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="delete" data-modal='0'>
            <div class="app-modal-header">Are you sure you want to delete this?</div>
            <div class="app-modal-body">You can not undo this action</div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                <a href="javascript:void(0)" class="app-btn a-btn-danger delete">Delete</a>
            </div>
        </div>
    </div>
</div>
{{-- ---------------------- Alert Modal ---------------------- --}}
<div class="app-modal" data-name="alert">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="alert" data-modal='0'>
            <div class="app-modal-header"></div>
            <div class="app-modal-body"></div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
            </div>
        </div>
    </div>
</div>
{{-- ---------------------- Settings Modal ---------------------- --}}
<div class="app-modal" data-name="settings">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="settings" data-modal='0'>
            <form id="update-settings" action="{{ route('avatar.update') }}" enctype="multipart/form-data"
                method="POST">
                @csrf
                {{-- <div class="app-modal-header">Update your profile settings</div> --}}
                <div class="app-modal-body">
                    {{-- Udate profile avatar --}}
                    <div class="avatar av-l upload-avatar-preview chatify-d-flex"
                        style="background-image: url('{{ Chatify::getUserWithAvatar(Auth::user())->avatar }}');"></div>
                    <p class="upload-avatar-details"></p>
                    <label class="app-btn a-btn-primary update" style="background-color:{{ $messengerColor }}">
                        Upload New
                        <input class="upload-avatar chatify-d-none" accept="image/*" name="avatar" type="file" />
                    </label>
                    {{-- Dark/Light Mode  --}}
                    <p class="divider"></p>
                    <p class="app-modal-header">Dark Mode <span
                            class="
                        {{ Auth::user()->dark_mode > 0 ? 'fas' : 'far' }} fa-moon dark-mode-switch"
                            data-mode="{{ Auth::user()->dark_mode > 0 ? 1 : 0 }}"></span></p>
                    {{-- change messenger color  --}}
                    <p class="divider"></p>
                    {{-- <p class="app-modal-header">Change {{ config('chatify.name') }} Color</p> --}}
                    <div class="update-messengerColor">
                        @foreach (config('chatify.colors') as $color)
                            <span style="background-color: {{ $color }}" data-color="{{ $color }}"
                                class="color-btn"></span>
                            @if (($loop->index + 1) % 5 == 0)
                                <br />
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="app-modal-footer">
                    <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                    <input type="submit" class="app-btn a-btn-success update" value="Save Changes" />
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ---------------------- Users Modal ---------------------- --}}
<div class="app-modal" style="overflow-y: scroll; " data-name="users">
    <div class="app-modal-container" style="margin-top: 7%; ">
        <div class="app-modal-card" style="margin-bottom: 5%" data-name="users" data-modal='0'>
            <div class="header-modal " style="display: flex;">
                <h6>Contact</h6>
                <a href="javascript:void(0)" class="cancel-users"
                    style="float: right; padding-left: 55%; text-decoration: none"><i class="fas fa-times "></i></a>
                <hr>
            </div>
            <table class="table list-all">
                {{-- <tr style="cursor: pointer;">
                    <td>
                        <a href="" style="text-decoration: none;">
                            <div class="avatar av-m" style="background-image: url('avatar.png');">
                            </div>
                        </a>
                    </td>
                    <td style="padding-top: 10%">
                        <a href="" style="text-decoration: none;">
                        <p>Ahmad Akbar 5</p>
                        </a>
                    </td>
                </tr> --}}
            </table>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel-users">Cancel</a>
            </div>
        </div>
    </div>
</div>
<script>
    
    $("body").on("click", ".users-btn", function(e) {
        e.preventDefault();
        app_modal({
            show: true,
            name: "users",
        });
        $.ajax({
            type: "get",
            url: location.origin + "/user",
            dataType: "JSON",
            success: function(data) {
                $('.list-all').empty();
                data.map((e, i) => {
                    $('.list-all').append(`
                    <tr style="cursor: pointer;">
                    <td >
                        <a href="${location.origin}/chatify/${e.id}" style="text-decoration: none;">
                            <div class="avatar av-m" style="background-image: url('${e.avatar}');">
                            </div>
                        </a>
                    </td>
                    <td style="padding-top: 10%; padding-left: 5%;">
                        <a href="${location.origin}/chatify/${e.id}" style="text-decoration: none;">
                            <p title="${e.name}">${e.name.slice(0,11)}...</p>
                        </a>
                    </td>
                </tr>`);
                });
            }
        });
    });
    // Settings modal [cancel button]
    $(".app-modal[data-name=users]")
        .find(".app-modal-footer .cancel-users")
        .on("click", function() {
            $('.list-all').empty();
            app_modal({
                show: false,
                name: "users",
            });
            cancelUpdatingAvatar();
        });
    $(".app-modal[data-name=users]")
        .find(".header-modal .cancel-users")
        .on("click", function() {
            $('.list-all').empty();
            app_modal({
                show: false,
                name: "users",
            });
            cancelUpdatingAvatar();
        });
</script>
