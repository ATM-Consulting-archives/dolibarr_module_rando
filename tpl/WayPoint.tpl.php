<!-- Un début de <div> existe de par la fonction dol_fiche_head() -->
	<input type="hidden" name="action" value="[view.action]" />
	<table width="100%" class="border">
		<tbody>



		</tbody>
	</table>
	
	<input id="addline" class="button" name="addline" type="submit" value="ajouter">

</div> <!-- Fin div de la fonction dol_fiche_head() -->

[onshow;block=begin;when [view.mode]='edit']
<div class="center">
	
	<!-- '+-' est l'équivalent d'un signe '>' (TBS oblige) -->
	[onshow;block=begin;when [object.id]+-0]
	<input type='hidden' name='id' value='[object.id]' />
	<input type="submit" value="[langs.transnoentities(Save)]" class="button" />
	[onshow;block=end]
	
	[onshow;block=begin;when [object.id]=0]
	<input type="submit" value="[langs.transnoentities(CreateDraft)]" class="button" />
	[onshow;block=end]
	
	<input type="button" onclick="javascript:history.go(-1)" value="[langs.transnoentities(Cancel)]" class="button">
	
</div>
[onshow;block=end]

[onshow;block=begin;when [view.mode]!='edit']
<div class="tabsAction">
	[onshow;block=begin;when [user.rights.rando.write;noerr]=1]
	
		[onshow;block=begin;when [object.status]=[level.STATUS_DRAFT]]
			
			<div class="inline-block divButAction"><a href="[view.urlcard]?id=[object.id]&action=validate" class="butAction">[langs.transnoentities(Validate)]</a></div>
			<div class="inline-block divButAction"><a href="[view.urlcard]?id=[object.id]&action=edit" class="butAction">[langs.transnoentities(Modify)]</a></div>
			
		[onshow;block=end]
		
		[onshow;block=begin;when [object.status]=[levl.STATUS_VALIDATED]]
			
			<div class="inline-block divButAction"><a href="[view.urlcard]?id=[object.id]&action=modif" class="butAction">[langs.transnoentities(Reopen)]</a></div>
			
		[onshow;block=end]
		
		<div class="inline-block divButAction"><a href="[view.urlcard]?id=[object.id]&action=clone" class="butAction">[langs.transnoentities(ToClone)]</a></div>
		
		<!-- '-+' est l'équivalent d'un signe '<' (TBS oblige) -->
		[onshow;block=begin;when [object.status]-+[rando.STATUS_REFUSED]]
			
			<div class="inline-block divButAction"><a href="[view.urlcard]?id=[object.id]&action=delete" class="butActionDelete">[langs.transnoentities(Delete)]</a></div>
			
		[onshow;block=end]
		
	[onshow;block=end]
</div>
[onshow;block=end]