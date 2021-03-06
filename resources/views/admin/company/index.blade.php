@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('companys/title.management')
@parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>Manage Company</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
       
        <li class="active">Company</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Company List
                    </h4>
                    <div class="pull-right">
                    <a href="{{ route('create/company') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br />
                <div class="panel-body">
                    @if (count($companys) >= 1)

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('groups/table.id')</th>
                                    <th>@lang('groups/table.name')</th>
                                    <th>@lang('groups/table.users')</th>
                                    <th>@lang('groups/table.created_at')</th>
                                    <th>@lang('groups/table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($companys as $company)
                                <tr>
                                    <td>{!! $company->id !!}</td>
                                    <td>{!! $company->name !!}</td>
                                       <td> <?php echo $cnt = DB::table('users')->where("COMPANY_ID","=",$company->id)->count(); ?> </td> 
                                    <td>{!! $company->created_at !!}</td>
                                    <td>
                                        <a href="{{ route('update/company', $company->id) }}">
                                                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit group"></i>
                                            </a>
                                            <!-- let's not delete 'Admin' group by accident -->
                                            
                                                    <a href="{{ route('confirm-delete/company', $company->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete group"></i>
                                                    </a>
                                               

                                          
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        @lang('general.noresults')
                    @endif   
                </div>
            </div>
        </div>
    </div>    <!-- row-->
</section>




@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" company="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        
     
    </div>
  </div>
</div>
<div class="modal fade" id="users_exists" tabindex="-2" company="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                @lang('groups/message.users_exists')
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});
    $(document).on("click", ".users_exists", function () {

        var group_name = $(this).data('name');
        $(".modal-header h4").text( group_name+" Company" );
    });</script>
@stop
