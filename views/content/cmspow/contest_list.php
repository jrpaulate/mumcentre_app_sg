<script type="text/javascript">
    $(document).ready(function(){
        var mum = {
            busy: function(){
                $('#loader').show();        
            },
            ready:function(){
                $('#loader').hide();        
            }
        }
        mum.ready();
    
    
        $('#checkall').bind('click',function(){
            mum.busy();
            $('input[type=checkbox][name=contest_id]').attr('checked',this.checked);
            mum.ready();
            return true;      
        })
        $('#selectcc').bind('change', function(){
            mum.busy();
            var cc = $('#selectcc').val();
            if (cc) location.href='/cms_pow/contest/list/' + cc;
            mum.ready();
            return false;
        });
    
        $('#copytocc').bind('change', function(){
            var values = frm.checkedValues();
            if (!values.length) {
                alert("Please select one contest...");
                return false;      
            }      
            var sel = this;
            var idx = sel.options.selectedIndex;
            var opt = sel[idx];
            var msg = "Copy the competition/s to " + opt.label + " ? ";
      
            if (! confirm(msg)) return false;
            mum.busy();
            var postdata = {ids:values.join(','), ccid: opt.value };
      
            $.post( '/cms_pow/contest/copy', postdata, function(data){
                alert(data.message);
                if (data.code >= 0) {
                    location.reload(true);          
                }
                mum.ready();
                return true; 
            },'json');
      
            return false;
        });
    
    
        var frm = {};    
        frm.checkedValues = function(){
            var values = [];      
            $('input[type=checkbox][name=contest_id]:checked').each(function(idx, elem){
                values.push( $(elem).val() );
            });      
            return values;
        }
    
        frm.copy = function (){
            var values = frm.checkedValues();
            if (!values.length) {
                alert("Please select one contest...");
                return false;      
            }
      
            if (! confirm("Duplicate selected contests?")) return false;
            var postdata = {ids:values.join(',')};
            mum.busy();
            $.post( this.href, postdata, function(data){
                alert(data.message);
                if (data.code >= 0) {
                    location.reload(true);          
                }
                mum.ready();
                return true; 
            },'json');
      
            return false;
        };
    
        frm.action = function (){      
            var values = frm.checkedValues();
            if (!values.length) return false;
      
            var msg = $(this).attr('title');
            var href =$(this).attr('href');
            if (! confirm(msg) ) return false;
            mum.busy();
            var jobs_done = 0;
            var imdone = function(data){
                jobs_done++;
                if(jobs_done == values.length) {
                    mum.ready();
                    location.reload();          
                }
            }
            $(values).each(function(idx, val){
                var act=href + '/' + val;
                var postdata = {id:val};
                $.post(act, postdata,function(data){
                    imdone();
                });
            });
            return false;
        }
    

        $('#btncopy').bind('click', frm.copy);
        $('#btndelete').bind('click', frm.action);
        /*
    $('#btnapprove').bind('click', frm.action);
    $('#btnpickwinner').bind('click', frm.action);*/
    });  
</script>
<script type="text/javascript" src="js/ICanHandlebarz.js"></script>
<script type="text/javascript" src="js/handlebars.js"></script>
<div id="content">

    <?php render_partial('pow/cmspow_nav'); ?>
    <div class="powcms-header">
        <h3>Manage Contests</h3>
    </div>
    <div class="powcms-header" style="padding-top: 2px;padding-bottom: 2px;">
        <form id="search_contest" name="search_contest">Search by ID: <input type="text" id="keyword" name="keyword"/><button type="submit"><img src="assets/img/system/img_search.png" /></button></form>
    </div>  
    <div class="powcms-table">
        <div class="powcms-submenu">
            <ul>
                <li id="loader"><span><img src="/img/loading.gif"/> Please wait...</span></li>
                <li>
                    <select name="selectcc" id="selectcc">
                        <option value="">Select Country</option>
                        <?php foreach ($data['country_list'] as $cc) : ?>
                            <?php $issel = ($data['CC'] == $cc['code']) ? " selected " : ''; ?>         
                            <option value="<?php echo $cc['code'] ?>" <?php echo $issel ?>>
                                <?php echo $cc['name'] ?></option>
                        <?php endforeach; ?>
                    </select></li>
                <li><a href="<?php echo site_url('cms_pow/contest/create'); ?>">Create New</a></li>
                <li><a href="<?php echo site_url('cms_pow/contest/copy'); ?>" id="btncopy">Duplicate Contests</a></li>
                <li><a href="<?php echo site_url('cms_pow/contest_delete'); ?>" id="btndelete" title="Delete contest/s?">Delete</a></li>
                <li>
                    <select name="copytocc" id="copytocc">
                        <option value="" selected="selected">Copy to country...</option>
                        <?php foreach ($data['country_list'] as $cc) : ?>
                            <option value="<?php echo $cc['id'] ?>"><?php echo $cc['name'] ?></option>
                        <?php endforeach; ?>
                    </select></li>
                <!--        
                <li>
                  <select name="movetocc" id="movetocc">
                  <option value="" selected="selected">Move to country...</option>
                <?php foreach ($data['country_list'] as $cc) : ?>
                      <option value="<?php echo $cc['id'] ?>"><?php echo $cc['name'] ?></option>
                <?php endforeach; ?>
                </select></li>
                -->        
            </ul>      
        </div>
        <table id="table" class="sortable">
            <thead>
                <tr>
                    <th class="nosort">
            <h3>
                <input type="checkbox" name="checkall" id="checkall">  
            </h3>            
            </th>
            <th><h3>ID</h3></th>
            <th><h3>Name</h3></th>
            <th align="center"><h3>Submission Period</h3></th>
            <th align="center"><h3>Voting Period</h3></th>
            <th class="nosort"><h3>Created</h3></th>          
            <th class="nosort"><h3>LastModified</h3></th>          
            <th class="nosort"><h3>Categories</h3></th>
            <th class="nosort"><h3>Submissions</h3></th>
            <th><h3>Status</h3></th>
            <th></th>
            </tr>
            </thead>
            <?php $cnt = 0; ?>
            <tbody id="contest-listing">
                <?php foreach ($data['contest_list'] as $row) : ?>
                    <?php
                    $is_active = (!!($row['status'] == ACTIVESUBMIT_CONTEST) || ($row['status'] == ACTIVEVOTING_CONTEST));
                    ?>
                    <tr class="powstat-<?php echo $row['status_name'] ?>">
                        <?php ++$cnt; ?>
                        <td>
                            <input type="checkbox" name="contest_id" id="contest_id<?php echo $cnt; ?>" value="<?php echo $row['id'] ?>">
                        </td>
                        <td><?php echo $row['id'] ?></td>
                        <td nowrap>
                            <a href="<?php echo site_url("cms_pow/contest/edit/{$row['id']}"); ?>">
                                <?php if ($is_active) : ?>
                                    <strong><?php echo $row['name'] ?> <span style="color:#f00;"> * </span></strong>
                                <?php else: ?>
                                    <?php echo $row['name'] ?>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td align="center">
                            <?php echo out_date($row['submission_start_date'], 'm/d/Y g:i:s A'); ?>  to  <?php echo out_date($row['submission_end_date'], 'm/d/Y g:i:s A'); ?>
                        </td>
                        <td align="center">
                            <?php echo out_date($row['voting_start_date'], 'm/d/Y g:i:s A'); ?>  to  <?php echo out_date($row['voting_end_date'], 'm/d/Y g:i:s A'); ?> 
                        </td>
                        <td align="center">
                            <?php echo out_datetime($row['created_date'], 'm/d/Y g:i:s A'); ?>            
                        </td>
                        <td align="center">
                            <?php echo out_datetime($row['modified_date'], 'm/d/Y g:i:s A'); ?>            
                        </td>
                        <td align="center">
                            <?php if ($row['status'] < ACTIVEVOTING_CONTEST) : ?>
                                <a href="<?php echo site_url("cms_pow/contest/categories/{$row['id']}"); ?>" class="tblcmd">Manage Categories</a>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <?php if ($row['status'] > INACTIVE_CONTEST) : ?>
                                <a href="<?php echo site_url("cms_pow/contest/entries/{$row['id']}"); ?>" class="tblcmd">Manage Submissions</a>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <?php echo $this->pow->label_contest_status[$row['status']]; ?>
                            <br/>
                            <?php if (@issetNE($row['approved_entries'])): ?>
                                [<?php echo $row['approved_entries'] ?> Approved Entries]
                            <?php endif; ?>
                            <?php if (@issetNE($row['pending_entries'])): ?>
                                [<?php echo $row['pending_entries'] ?> Pending Entries]            
                            <?php endif; ?>
                        </td>
                        <td>

                            <?php if ($row['status'] == INACTIVE_CONTEST) : ?>
                                <a href="<?php echo site_url("cms_pow/contest/forsubmission/{$row['id']}"); ?>" class="tblcmd">Activate for Submission</a>
                            <?php endif; ?>

                            <?php if ($row['status'] == ACTIVESUBMIT_CONTEST) : ?>
                                <a href="<?php echo site_url("cms_pow/contest/forvoting/{$row['id']}"); ?>" class="tblcmd">Activate for Voting</a>
                            <?php endif; ?>

                            <?php if ($row['status'] == ACTIVEVOTING_CONTEST) : ?>
                                <a href="<?php echo site_url("cms_pow/contest/conclude/{$row['id']}/"); ?>" class="tblcmd">End Voting Period</a>
                                <!-- <a href="<?php echo site_url("cms_pow/contest/winners/{$row['id']}/"); ?>" class="tblcmd">View Winners</a>-->
                            <?php endif; ?>

                            <?php if ($row['status'] == CONCLUDED_CONTEST) : ?>
                                <a href="<?php echo site_url("cms_pow/contest/publish/{$row['id']}/"); ?>" class="tblcmd">Publish Contest</a>
                                <a href="<?php echo site_url("cms_pow/contest/winners/{$row['id']}/"); ?>" class="tblcmd">View Winners</a>
                            <?php endif; ?>

                            <?php if ($row['status'] == PUBLISHED_CONTEST) : ?>
                                <a href="<?php echo site_url("cms_pow/contest/conclude/{$row['id']}/"); ?>" class="tblcmd">Unpublish Contest</a>
                                <a href="<?php echo site_url("cms_pow/contest/winners/{$row['id']}/"); ?>" class="tblcmd">View Winners</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div id="controls">
            <div id="perpage">
                <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20" selected="selected">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>Entries Per Page</span>
            </div>
            <div id="navigation">
                <img src="images/sorter/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                <img src="images/sorter/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                <img src="images/sorter/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                <img src="images/sorter/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
            </div>
            <div id="text">
                Displaying Page <span id="currentpage"></span> of <span id="pagelimit"></span>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#search_contest').submit(function(e){
            $('#loader').css('display','');
            var keyword = $('#keyword').val();
            var code = $('#selectcc').val();
            if(!keyword){
                keyword = 0;
            }
            $.get("pow/search_contest/"+keyword+"/"+code, function(response) {
                var data = JSON.parse(response);
                var template = ich.contest_list_tpl(data);
                $('#contest-listing').html('');
                $('#contest-listing').append(template);
                return false;
            });
//            alert(keyword);
            $('#loader').css('display','none');
            e.preventDefault();
        });
        var sorter = window.sorter = new TINY.table.sorter("sorter");
        sorter.head = "head";
        sorter.asc = "asc";
        sorter.desc = "desc";
        sorter.even = "evenrow";
        sorter.odd = "oddrow";
        sorter.evensel = "evenselected";
        sorter.oddsel = "oddselected";
        sorter.paginate = true;
        sorter.currentid = "currentpage";
        sorter.limitid = "pagelimit";
        sorter.init("table",9);
  
    });
</script>
<script type="text/html" id="contest_list_tpl">
{{#results}}
        {{#result}}
        <tr class="powstat-{{status_name}}">
    <?php ++$cnt; ?>
            <td>
                <input type="checkbox" name="contest_id" id="contest_id<?php echo $cnt; ?>" value="{{id}}">
            </td>
            <td>{{id}}</td>
            <td nowrap>
                <a href="cms_pow/contest/edit/{{id}}">
                    {{#if active}}
                    <strong>{{name}}<span style="color:#f00;"> * </span></strong>
                    {{else}}
                    {{name}}
                    {{/if}}
                </a>
            </td>
            <td align="center">
                {{submission_start_date}}  to  {{submission_end_date}}
            </td>
            <td align="center">
                {{voting_start_date}}  to  {{voting_end_date}}
            </td>
            <td align="center">
                {{created_date}}
            </td>
            <td align="center">
                {{modified_date}}         
            </td>
            <td align="center">
            {{#if less_active}}
                    <a href="cms_pow/contest/categories/{{id}}" class="tblcmd">Manage Categories</a>
            {{/if}}
            </td>
            <td align="center">
            {{#if active}}
                    <a href="cms_pow/contest/entries/{{id}}" class="tblcmd">Manage Submissions</a>
            {{/if}}
            </td>
            <td align="center">
            {{status_definition}}
            </td>
            <td>
                
            {{#if inactive}}
                    <a href="cms_pow/contest/forsubmission/{{id}}" class="tblcmd">Activate for Submission</a>
            {{/if}}
                
            {{#if active_submit}}
                    <a href="cms_pow/contest/forvoting/{{id}}" class="tblcmd">Activate for Voting</a>
            {{/if}}
                
            {{#if active_voting}}
                    <a href="cms_pow/contest/conclude/{{id}}" class="tblcmd">End Voting Period</a>
            {{/if}}
                
            {{#if concluded}}
                    <a href="cms_pow/contest/publish/{{id}}" class="tblcmd">Publish Contest</a>
                    <a href="cms_pow/contest/winners/{{id}}" class="tblcmd">View Winners</a>
            {{/if}}

            {{#if published}}
                    <a href="cms_pow/contest/conclude/{{id}}" class="tblcmd">Unpublish Contest</a>
                    <a href="cms_pow/contest/winners/{{id}}" class="tblcmd">View Winners</a>
            {{/if}}
            </td>
        </tr>
        {{/result}}
{{/results}}        
</script>