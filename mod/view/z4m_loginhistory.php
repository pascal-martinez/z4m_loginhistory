<?php
/**
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://mobile.znetdk.fr
 * Copyright (C) 2024 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL https://www.gnu.org/licenses/gpl-3.0.html GNU GPL
 * --------------------------------------------------------------------
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * ZnetDK 4 Mobile Login History module view
 *
 * File version: 1.0
 * Last update: 05/04/2024
 */
?>
<!-- Filter by dates and status -->
<form id="z4m-login-history-list-filter" class="w3-padding w3-panel w3-theme-l2">
    <div class="w3-cell w3-mobile">
        <div class="w3-cell no-wrap"><i class="fa fa-calendar"></i>&nbsp;<b><?php echo MOD_Z4M_LOGINHISTORY_LIST_FILTER_PERIOD; ?></b>&nbsp;</div>
        <div class="w3-cell w3-mobile">
            <input class="w3-padding" type="date" name="start_filter">
            <input class="w3-padding w3-margin-right" type="date" name="end_filter">
        </div>
    </div>
    <div class="w3-cell w3-mobile">
        <div class="w3-cell no-wrap"><i class="fa fa-list"></i>&nbsp;<b><?php echo MOD_Z4M_LOGINHISTORY_LIST_STATUS_LABEL; ?></b>&nbsp;</div>
        <div class="w3-cell no-wrap">
            <input id="z4m-login-history-list-filter-status-all" class="w3-radio" type="radio" value="" name="status_filter" checked>
            <label for="z4m-login-history-list-filter-status-all"><?php echo MOD_Z4M_LOGINHISTORY_LIST_FILTER_STATUS_ALL; ?></label>&nbsp;&nbsp;
            <input id="z4m-login-history-list-filter-status-ok" class="w3-radio" type="radio" value="1" name="status_filter">
            <label for="z4m-login-history-list-filter-status-ok"><?php echo MOD_Z4M_LOGINHISTORY_STATUS_SUCCESS; ?></label>&nbsp;&nbsp;
            <input id="z4m-login-history-list-filter-status-ko" class="w3-radio" type="radio" value="0" name="status_filter">
            <label for="z4m-login-history-list-filter-status-ko"><?php echo MOD_Z4M_LOGINHISTORY_STATUS_FAILED; ?></label>
        </div>
    </div>
</form>
<!-- Header -->
<div id="z4m-login-history-list-header" class="w3-row w3-text-theme w3-theme-light w3-hide-small w3-border-bottom w3-border-theme">
    <div class="w3-col m3 l3 w3-padding-small"><b><?php echo MOD_Z4M_LOGINHISTORY_LIST_DATETIME_LABEL; ?></b></div>
    <div class="w3-col m2 l2 w3-padding-small"><b><?php echo MOD_Z4M_LOGINHISTORY_LIST_USER_LABEL; ?></b></div>
    <div class="w3-col m4 l5 w3-padding-small"><b><?php echo MOD_Z4M_LOGINHISTORY_LIST_LOGIN_LABEL; ?></b></div>
    <div class="w3-col m3 l2 w3-padding-small"><b><?php echo MOD_Z4M_LOGINHISTORY_LIST_STATUS_LABEL; ?></b></div>
</div>
<!-- List of user logins -->
<ul id="z4m-login-history-list" class="w3-ul w3-hide" data-zdk-load="Z4MLoginHistoryCtrl:all">
    <li class="w3-border-theme">
        <div class="w3-row w3-stretch">
            <div class="w3-col s6 m3 l3 w3-padding-small"><b>{{login_date_locale}}</b></div>
            <div class="w3-col s6 m2 l2 w3-padding-small">
                {{user_unknown_alert}}
                <b class="{{user_class}}">{{user_name}}</b>
            </div>
            <div class="w3-col s12 m4 l5 w3-padding-small">
                <span class="w3-tag w3-theme-l2">{{login_name}}</span>
                <i class="fa fa-globe"></i> {{ip_address}}
                <div class="user-agent w3-small" title="{{user_agent}}">
                    <i class="fa fa-window-maximize"></i> {{user_agent}}
                </div>
            </div>
            <div class="w3-col s12 m3 l2 w3-padding-small">
                <div class="w3-row">
                    <div class="w3-col status-col" style="">
                        <span class="w3-tag {{status_class}}">{{status_label}}</span>
                    </div>
                    <div class="w3-rest">{{message}}</div>
                </div>
            </div>
        </div>
    </li>
    <li><h3 class="w3-red w3-center"><i class="fa fa-frown-o"></i>&nbsp;<?php echo LC_MSG_INF_NO_RESULT_FOUND; ?></h3></li>
</ul>
<style>
    #z4m-login-history-list-filter .no-wrap {
        white-space: nowrap;
    }
    #z4m-login-history-list-header {
        position: sticky;
    }
    #z4m-login-history-list .user-agent {
        margin-top: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    #z4m-login-history-list .status-col {
        width: 36px;
        font-family: monospace;
        font-weight: 600;
    }
</style>
<script>
    <?php if (CFG_DEV_JS_ENABLED) : ?>
    console.log("'z4m_loginhistory' ** For debug purpose **");
    <?php endif; ?>
    $(function(){
        // History list is instantiated
        const historyList = znetdkMobile.list.make('#z4m-login-history-list', true, false);
        // Filters applied before list loading
        historyList.beforeSearchRequestCallback = function(requestData) {
            const filterForm = z4m.form.make('#z4m-login-history-list-filter'),
                status = filterForm.getInputValue('status_filter'),
                startDate = filterForm.getInputValue('start_filter'),
                endDate = filterForm.getInputValue('end_filter');
                filters = {};
            if (status !== '') {
                filters.status = status;
            }
            if (startDate !== '') {
                filters.start = startDate;
            }
            if (endDate !== '') {
                filters.end = endDate;
            }
            if (Object.keys(filters).length > 0) {
                requestData.search_criteria = JSON.stringify(filters);
            }
        };
        // Customization of the list display
        historyList.beforeInsertRowCallback = function(rowData) {
            rowData.user_unknown_alert = rowData.is_user_unknown === '1' ? '<i class="fa fa-exclamation w3-text-red"></i>' : '';
            rowData.user_class = 'w3-text-' + (rowData.is_user_unknown === '1' ? 'red' : 'green');
            rowData.status_class = rowData.status_label === 'OK' ? 'w3-green' : 'w3-red';
            if (rowData.message.length > 0) {
                const colorClass = rowData.status_label === 'OK' ? 'blue' : 'red';
                const iconClass = rowData.status_label === 'OK' ? 'info-circle' : 'warning';
                rowData.message = '<span class="w3-text-' + colorClass
                        + '"><i class="fa fa-' + iconClass + '"></i> <b>'
                        + rowData.message + '</b></span>';
            }
        };
        // Filter change events
        $('#z4m-login-history-list-filter input').on('change.z4m_loginhistory', function(){
            if ($(this).attr('name') === 'start_filter') {
                const startDate = new Date($(this).val()),
                    endDateEl = $('#z4m-login-history-list-filter input[name=end_filter]'),
                    endDate = new Date(endDateEl.val());
                if (startDate > endDate) {
                    endDateEl.val($(this).val());
                }
            } else if ($(this).attr('name') === 'end_filter') {
                const endDate = new Date($(this).val()),
                    startDateEl = $('#z4m-login-history-list-filter input[name=start_filter]'),
                    startDate = new Date(startDateEl.val());
                if (startDate > endDate) {
                    startDateEl.val($(this).val());
                }
            }
            historyList.refresh();
        });
        // List header sticky position taking in account ZnetDK autoHideOnScrollEnabled property
        onTopSpaceChange();
        $('body').on('topspacechange.z4m_loginhistory', onTopSpaceChange);
        function onTopSpaceChange() {
            $('#z4m-login-history-list-header').css('top', znetdkMobile.header.autoHideOnScrollEnabled
                ? 0 : znetdkMobile.header.getHeight()-1);
        }
    });
</script>