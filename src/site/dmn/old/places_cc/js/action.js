function deleteCity (cont, action, id, parent_id) {
	jQuery("#citys-list").load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html&id=" + id + "&parent_id=" + parent_id);
	return false;
}
