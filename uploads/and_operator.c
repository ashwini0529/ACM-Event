#include<stdio.h>
int main()
{
	int n,i=2;
	int flag=0;
	scanf("%d",&n);
	for(i;i<n/2;i++)
	{
		if(n%i==0)
		{
		printf("NOT PRIME...");
		flag=1;
		break;
		
		}
	
	}
	if(flag==0)
	{
		printf("\nPRIME");
	}
}
