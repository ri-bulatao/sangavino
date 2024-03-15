@if (url()->current() === route('admin.services.index'))
    {{-- Creating service --}}
    <div class="modal fade" id="m_service" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_service_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_service_header">
                    <h6 class="modal-title text-white" id="m_service_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-4">
                    <form class="service_form" autocomplete="off">
                        <div class="form-group mb-3">
                            <label class="form-label">Service *</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Description *</label>
                            <textarea class="form-control" name="description" rows="4"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Fee *</label>
                            <input type="number" min="0" class="form-control" name="fee">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_service btn-success"
                        onclick="c_store('.service_form','.service_dt', 'admin.services.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_service btn-warning"
                        onclick="c_update('.service_form','.service_dt', 'admin.services.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating service --}}
@endif

@if (url()->current() === route('admin.puroks.index'))
    {{-- Creating purok --}}
    <div class="modal fade" id="m_purok" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_purok_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_purok_header">
                    <h6 class="modal-title text-white" id="m_purok_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-4">
                    <form class="purok_form" autocomplete="off">
                        <div class="form-group mb-3">
                            <label class="form-label">Purok *</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_purok btn-success"
                        onclick="c_store('.purok_form','.purok_dt', 'admin.puroks.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_purok btn-warning"
                        onclick="c_update('.purok_form','.purok_dt', 'admin.puroks.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating purok --}}
@endif

@if (url()->current() === route('admin.residents.index'))
    {{-- Creating resident --}}
    <div class="modal fade" id="m_resident" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_resident_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_resident_header">
                    <h6 class="modal-title text-white" id="m_resident_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-4">
                    <form class="resident_form row" autocomplete="off">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label">Purok *</label>
                                <select class="form-control" name="purok_id" id="d_puroks">
                                    {{-- display puroks --}}
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" name="first_name">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Middle Name *</label>
                                <input type="text" class="form-control" name="middle_name">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" name="last_name">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Gender *</label>
                                <select class="form-control" name="gender">
                                    <option value=""></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Birth Date *</label>
                                <input type="date" max="2008-01-01" class="form-control" name="birth_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Contact *</label>
                                <input type="number" class="form-control" min="0" name="contact">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Civil Status *</label>
                                <select class="form-control" name="civil_status">
                                    <option value=""></option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Citizenship *</label>
                                <input type="text" class="form-control" name="citizenship">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Is Registered Voter *</label>
                                <select class="form-control" name="is_voter">
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Email </label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_resident btn-success"
                        onclick="c_store('.resident_form','.resident_dt', 'admin.residents.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_resident btn-warning"
                        onclick="c_update('.resident_form','.resident_dt', 'admin.residents.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating resident --}}
@endif

@if (url()->current() === route('admin.blotters.index'))
    {{-- Creating blotter --}}
    <div class="modal fade" id="m_blotter" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_blotter_title" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_blotter_header">
                    <h6 class="modal-title text-white" id="m_blotter_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-4">
                    <form class="blotter_form" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group mb-3">
                            <label class="form-label">Complainant (Complete Name) *</label>
                            <input type="text" class="form-control" name="complainant">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Respondent (Complete Name) </label>
                            <input type="text" class="form-control" name="respondent">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Location * </label>
                            <input type="text" class="form-control" name="location"
                                placeholder="Enter Complete Location of Incident">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Date Of Incident * </label>
                            <input type="text" class="form-control" name="location"
                                placeholder="Enter Complete Location of Incident">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Statement *</label>
                            <textarea class="form-control" name="statement" rows="5" placeholder="Add Statement"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">In-Charge (Complete Name) *</label>
                            <input type="text" class="form-control" name="incharge">
                        </div>
                        <div>
                            <input class="blotters" type="file" name="image[]" data-allow-reorder="true"
                                data-max-files="5" multiple>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_blotter btn-success"
                        onclick="c_store('.blotter_form','.blotter_dt', 'admin.blotters.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_blotter btn-warning"
                        onclick="c_update('.blotter_form','.blotter_dt', 'admin.blotters.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating blotter --}}
@endif


@if (url()->current() === route('admin.positions.index'))
    {{-- Creating position --}}
    <div class="modal fade" id="m_position" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_position_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_position_header">
                    <h6 class="modal-title text-white" id="m_position_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-4">
                    <form class="position_form" autocomplete="off">
                        <div class="form-group mb-2">
                            <label class="form-label">Select Parent Position *</label>
                            <select class="form-control" name="pid" id="d_positions">
                                {{-- display positions --}}
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Position *</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_position btn-success"
                        onclick="c_store('.position_form','.position_dt', 'admin.positions.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_position btn-warning"
                        onclick="c_update('.position_form','.position_dt', 'admin.positions.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating position --}}
@endif

@if (url()->current() === route('admin.officials.index'))
    {{-- Creating official --}}
    <div class="modal fade" id="m_official" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_official_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_official_header">
                    <h6 class="modal-title text-white" id="m_official_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-4">
                    <form class="official_form" autocomplete="off">
                        <div class="form-group mb-2">
                            <label class="form-label">Select Position *</label>
                            <select class="form-control" name="position_id" id="d_positions">
                                {{-- display positions --}}
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Official *</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Contact *</label>
                            <input type="text" class="form-control" name="contact">
                        </div>
                        <div>
                            <input class="avatar_image" type="file" name="image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_official btn-success"
                        onclick="c_store('.official_form','.official_dt', 'admin.officials.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_official btn-warning"
                        onclick="c_update('.official_form','.official_dt', 'admin.officials.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating official --}}
@endif


@if (url()->current() === route('admin.categories.index'))
    {{-- Creating category --}}
    <div class="modal fade" id="m_category" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="m_category_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="m_category_header">
                    <h6 class="modal-title text-white" id="m_category_title">{{-- Modal Title --}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form class="category_form" autocomplete="off">
                        <label class="form-label">Enter Category *</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_category btn-success"
                        onclick="c_store('.category_form','.category_dt', 'admin.categories.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_category btn-warning"
                        onclick="c_update('.category_form','.category_dt', 'admin.categories.update', event)">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Creating category --}}
@endif
