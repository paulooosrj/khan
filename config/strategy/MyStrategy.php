<?php
	
	namespace StrategysAuth;

	class MyStrategy {

		const table = "login";
		const logout = "./login";
		const ignoreSession = ["password"];

		const login = [
			"email", "password"
		];

		const register = [
			"email", "password", "name"
		];

	}
