"use strict";

window.khan_socket = (function(socketIo){

	const server = "http://khan-socket-server.fr.openode.io";
	const socket = socketIo(server);
	const origin = (channel) => location.hostname + channel;

	return {
		emit(channel, data){
			socket.emit('channel', {
				[origin(channel)]: data
			});
		},
		on(channel, call){
			socket.on(origin(channel), call);
		}
	};

})(io);
