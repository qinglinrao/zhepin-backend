<div class="merchant-detail-info">
    <div class="personal-info">
        <img src="{{$leader->image?AppHelper::imgSrc($leader->image->url):''}}" />
        <table >
            <tr>
                <td>
                    <b>{{$leader->username}}</b>
                    <div class="action-button-groups">
                        {{get_merchant_detail_status_action($leader)}}
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <e>注册时间:{{$leader->created_at}}</e> |
                    <e>所在地:{{$leader->region_id}}</e> |
                    <e>手机号:{{$leader->mobile}}</e> |
                    <e>身份证号:{{$leader->identity_num}}</e> |
                    <e>状态: {{get_merchant_status()[$leader->status]}}</e>
                </td>
            </tr>
        </table>
    </div>
</div>