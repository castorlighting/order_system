  	/*
	 * License
	 
	 * Copyright 2015 DevWurm
	
	 * This file is part of order_system.

	 *  order_system is free software: you can redistribute it and/or modify
	    it under the terms of the GNU General Public License as published by
	    the Free Software Foundation, either version 3 of the License, or
	    (at your option) any later version.
	
	    order_system is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU General Public License for more details.
	
	    You should have received a copy of the GNU General Public License
	    along with order_system.  If not, see <http://www.gnu.org/licenses/>.
	
	    Diese Datei ist Teil von order_system.
	
	    order_system ist Freie Software: Sie können es unter den Bedingungen
	    der GNU General Public License, wie von der Free Software Foundation,
	    Version 3 der Lizenz oder (nach Ihrer Wahl) jeder späteren
	    veröffentlichten Version, weiterverbreiten und/oder modifizieren.
	
	    order_system wird in der Hoffnung, dass es nützlich sein wird, aber
	    OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite
	    Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
	    Siehe die GNU General Public License für weitere Details.
	
	    Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
	    Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
*/

//select the product_name child of the form element
function select_product_name_node(node_list) {
	for (var i = 0; i<=node_list.length; i++) {
		if (node_list[i].name == 'product_name') {
			return node_list[i];
		}
	}
}

//check if user name is existing and not too long; color input field red if an error occured
function validate_product_input(form_id) {
	var form = document.getElementById(form_id);
	var product_name = select_product_name_node(form);
	
	if (product_name.value.length > 255 ) {
		product_name.setAttribute('class', 'red_placeholder');
		product_name.placeholder = "Benutzername (maximal 50 Zeichen)";
		product_name.value='';
		return false;
	} 
	else if (product_name.value.length == 0) {
		product_name.setAttribute('class', 'red_placeholder');
		return false;
	}
	else {
		product_name.setAttribute('class', '');
		return true;
	}
}
