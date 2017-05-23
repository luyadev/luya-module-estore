<div ng-repeat="item in data">
    <b>{{ item.set.name }}</b>
    <div ng-repeat="attr in item.attributes">
        <zaa-injector dir="attr.input" options="attr.values_json" fieldid="{{attr.id}}_{{item.set.id}}" fieldname="{{attr.id}}_{{item.set.id}}" label="{{attr.name}}" model="model[item.set.id][attr.id]"></zaa-injector>
    </div>
</div>