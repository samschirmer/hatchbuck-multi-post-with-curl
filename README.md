# hatchbuck-multi-post-with-curl

Note that you will need to first create the form in Hatchbuck in order to get the proper input names for the final POST. Contacts will eventually end up on the "Thank You Page" as specified on that form in Hatchbuck, so make sure you configure that as well. 

!IMPORTANT! 
By default, Hatchbuck uses a 303 redirect to handle form submissions, which can be turned on or off via a hidden value in the form HTML itself. Make sure enable303Redirect is set to a value of 0:

	<input name="enable303Redirect" type="hidden" value="0"> 
