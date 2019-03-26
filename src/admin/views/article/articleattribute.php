<div class="card mb-3" ng-repeat="item in data" ng-class="{'card-closed': !groupVisibility}" ng-init="groupVisibility=1">
	<div class="card-header text-uppercase" ng-click="groupVisibility=!groupVisibility">
		<span class="material-icons card-toggle-indicator">keyboard_arrow_down</span>
		{{ item.set.name }}
	</div>
	<div class="card-body" ng-show="groupVisibility">
		<div ng-repeat="attr in item.attributes">
			<zaa-injector dir="attr.input" options="attr.values_json" fieldid="{{attr.id}}_{{item.set.id}}" fieldname="{{attr.id}}_{{item.set.id}}" label="{{attr.name}}" model="model[item.set.id][attr.id]"></zaa-injector>
		</div>
	</div>
</div> 	</div> 