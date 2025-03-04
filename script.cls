Sub TambahBarisDanIsiFormula()
    Dim ws As Worksheet
    Dim lastRow As Long
    Dim i As Long
    
    Set ws = ActiveSheet
    lastRow = ws.Cells(ws.Rows.Count, "A").End(xlUp).Row ' Mencari baris terakhir di kolom A
    
    Application.ScreenUpdating = False ' Mempercepat eksekusi kode
    
    ' Loop dari baris terakhir ke pertama untuk menghindari pergeseran data
    For i = lastRow To 1 Step -1
        ' Menyisipkan 4 baris kosong
        ws.Rows(i + 1 & ":" & i + 4).Insert Shift:=xlDown
        
        ' Mengisi baris baru dengan formula custom (Nilai A + 1)
        ws.Cells(i + 1, 1).Formula = "=A" & i & "+1"
        ws.Cells(i + 2, 1).Formula = "=A" & i & "+2"
        ws.Cells(i + 3, 1).Formula = "=A" & i & "+3"
        ws.Cells(i + 4, 1).Formula = "=A" & i & "+4"
        
        ' Kolom B :
        ws.Cells(i + 1, 2).Formula = "=B" & i & "+((B" & i + 5 & "-B" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 2).Formula = "=B" & i & "+((B" & i + 5 & "-B" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 2).Formula = "=B" & i & "+((B" & i + 5 & "-B" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 2).Formula = "=B" & i & "+((B" & i + 5 & "-B" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom C :
        ws.Cells(i + 1, 3).Formula = "=C" & i & "+((C" & i + 5 & "-C" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 3).Formula = "=C" & i & "+((C" & i + 5 & "-C" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 3).Formula = "=C" & i & "+((C" & i + 5 & "-C" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 3).Formula = "=C" & i & "+((C" & i + 5 & "-C" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom D :
        ws.Cells(i + 1, 4).Formula = "=D" & i & "+((D" & i + 5 & "-D" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 4).Formula = "=D" & i & "+((D" & i + 5 & "-D" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 4).Formula = "=D" & i & "+((D" & i + 5 & "-D" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 4).Formula = "=D" & i & "+((D" & i + 5 & "-D" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom E :
        ws.Cells(i + 1, 5).Formula = "=E" & i & "+((E" & i + 5 & "-E" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 5).Formula = "=E" & i & "+((E" & i + 5 & "-E" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 5).Formula = "=E" & i & "+((E" & i + 5 & "-E" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 5).Formula = "=E" & i & "+((E" & i + 5 & "-E" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom F :
        ws.Cells(i + 1, 6).Formula = "=F" & i & "+((F" & i + 5 & "-F" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 6).Formula = "=F" & i & "+((F" & i + 5 & "-F" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 6).Formula = "=F" & i & "+((F" & i + 5 & "-F" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 6).Formula = "=F" & i & "+((F" & i + 5 & "-F" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom G :
        ws.Cells(i + 1, 7).Formula = "=G" & i & "+((G" & i + 5 & "-G" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 7).Formula = "=G" & i & "+((G" & i + 5 & "-G" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 7).Formula = "=G" & i & "+((G" & i + 5 & "-G" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 7).Formula = "=G" & i & "+((G" & i + 5 & "-G" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom H :
        ws.Cells(i + 1, 8).Formula = "=H" & i & "+((H" & i + 5 & "-H" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 8).Formula = "=H" & i & "+((H" & i + 5 & "-H" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 8).Formula = "=H" & i & "+((H" & i + 5 & "-H" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 8).Formula = "=H" & i & "+((H" & i + 5 & "-H" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom I :
        ws.Cells(i + 1, 9).Formula = "=I" & i & "+((I" & i + 5 & "-I" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 9).Formula = "=I" & i & "+((I" & i + 5 & "-I" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 9).Formula = "=I" & i & "+((I" & i + 5 & "-I" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 9).Formula = "=I" & i & "+((I" & i + 5 & "-I" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
        ' Kolom J :
        ws.Cells(i + 1, 10).Formula = "=J" & i & "+((J" & i + 5 & "-J" & i & ")*((A" & i + 1 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 2, 10).Formula = "=J" & i & "+((J" & i + 5 & "-J" & i & ")*((A" & i + 2 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 3, 10).Formula = "=J" & i & "+((J" & i + 5 & "-J" & i & ")*((A" & i + 3 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        ws.Cells(i + 4, 10).Formula = "=J" & i & "+((J" & i + 5 & "-J" & i & ")*((A" & i + 4 & "-A" & i & ")/(A" & i + 5 & "-A" & i & ")))"
        
    Next i
    
    Application.ScreenUpdating = True ' Mengembalikan tampilan normal
    
    MsgBox "Penambahan baris dan pengisian fungsi selesai!", vbInformation, "Selesai"
End Sub