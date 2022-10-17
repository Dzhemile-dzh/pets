# Request ID component

It would be great to have a ability to trace request call through all possible logs. This component provides a unique tag id for all logs for trace requests.

`homepage.log`
```
2017-05-30 08:52:05.925 - INFO - [5cb55bce5e6610c9e9035f376f1019c8f912342a] - <<MESSAGE A>>
2017-05-30 08:52:06.025 - INFO - [5cb55bce5e6610c9e9035f376f1019c8f912342a] - <<MESSAGE B>>
```

`api.log`
```
2017-05-30 08:52:06.017 - INFO - [5cb55bce5e6610c9e9035f376f1019c8f912342a] - <<MESSAGE 1>>
2017-05-30 08:52:06.022 - INFO - [5cb55bce5e6610c9e9035f376f1019c8f912342a] - <<MESSAGE 2>>
```