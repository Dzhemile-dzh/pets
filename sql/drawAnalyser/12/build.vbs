'==============================================================================
Class scriptClass

    Public objFSO
    Public objTmp
    Public prefix
    Public tempFile
    Public configFile
    Public buildFile

    '====================================
    Private Sub Class_Initialize()
        If WScript.Arguments.Count > 0 Then
            prefix = WScript.Arguments(0)
        Else
            prefix = ""
        End If
    End Sub

    '====================================
    Private Sub Class_Terminate()
        Set objFSO = Nothing
        Set objTmp = Nothing
    End Sub

    '====================================
    Public Sub run
        ' delete temporary file if exists, create the new one
        Set objFSO = CreateObject("Scripting.FileSystemObject")
        If objFSO.FileExists(tempFile) Then
            objFSO.DeleteFile(tempFile)
        End If

        If objFSO.FileExists(configFile) Then
            Set objTmp = objFSO.CreateTextFile(tempFile, true)

            Set objFSO = CreateObject("Scripting.FileSystemObject")
            Set config = objFSO.OpenTextFile(configFile)

            ' read configuration file
            Do While Not config.AtEndOfStream
                line = config.ReadLine
                If objFSO.FileExists(line) Then
                    Set stream = objFSO.OpenTextFile(line)
                    out = out & stream.ReadAll
                Else
                    If LCase(Mid(line,1,3)) = "use" Then
                        line = "use " & prefix & Trim(LCase(Mid(line,4,Len(line))))
                    End If
                    out = out & line & vbCrLf
                End If
            Loop

            objTmp.Write(out)
            objTmp.Close

            Set objFSO = CreateObject("Scripting.FileSystemObject")
            Set objTmp = objFSO.OpenTextFile(tempFile)

            pattern = "work_horse."

            If len(trim(prefix)) > 0 Then

                strText = objTmp.ReadAll
                strNewText = Replace(strText, pattern, prefix & pattern)
                objTmp.Close()

                Set objTmp = objFSO.CreateTextFile(buildFile, true)

                objTmp.WriteLine(strNewText)

                objTmp.Close()
                objFSO.DeleteFile(tempFile)
            Else
                objTmp.Close()
                If objFSO.FileExists(buildFile) Then
                    objFSO.DeleteFile(buildFile)
                End If
                objFSO.MoveFile tempFile, buildFile
            End If
            Set config = Nothing

            MsgBox "File " & buildFile & " has been succesfully created."
        Else
            MsgBox "Could not find the configuration file " & configFile
        End If
    End Sub
End Class

'==============================================================================
' Preparing script
'==============================================================================
Set script = New scriptClass
script.configFile = "build.txt"
script.tempFile = "_$$tmp$$_"
script.buildFile = "_build_DA.sql"

script.run
