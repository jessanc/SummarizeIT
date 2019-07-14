<?php
echo("hello");
system("ls");
system("/home/ec2-user/Omkar/Basic-Recording/On-Premise-Recording-C++/samples/cpp/recorder_local --appId e760fdaba8e04bbfa13750f543294e61 --uid 0 --channel toi --appliteDir /home/ec2-user/Omkar/Basic-Recording/On-Premise-Recording-C++/bin/ --isMixingEnabled 1 --mixedVideoAudio 2 &>/dev/null &");
#AUDIO ONLY
system("/home/ec2-user/Omkar/Basic-Recording/On-Premise-Recording-C++/samples/cpp/recorder_local --appId e760fdaba8e04bbfa13750f543294e61 --uid 0 --channel toi --appliteDir /home/ec2-user/Omkar/Basic-Recording/On-Premise-Recording-C++/bin/ --isAudioOnly 1 --isMixingEnabled 1  &>/dev/null &");

header("Location: https://72a728e3.ngrok.io/meeting.html");

?>
